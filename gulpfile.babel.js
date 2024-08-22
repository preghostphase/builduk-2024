// Project variables
const projectURL = "http://tonic-talent.local/",
	browserAutoOpen = ! 1,
	injectChanges = ! 0,
	styleSRC = "./assets/scss/style.scss",
	styleSRCBlocks = "./assets/scss/blocks/blocks.scss",
	styleDestination = "./dist/css/",
	outputStyle = "compact",
	errLogToConsole = ! 0,
	precision = 10,
	jsCustomDestination = "./dist/js/",
	imgSRC = "./assets/images/**/*",
	imgDST = "./dist/images/",
	watchStyles = "./assets/scss/**/*.scss",
	watchJsAll = "./assets/js/**/*.js",
	watchPhp = "./**/*.php",
	zipName = "theme.zip",
	zipDestination = "./../",
	zipIncludeGlob = ["./**/*"],
	zipIgnoreGlob = [
		"!./{node_modules,node_modules/**/*}",
		"!./.git",
		"!./.svn",
		"!./gulpfile.babel.js",
		"!./wpgulp.js",
		"!./.eslintrc.js",
		"!./.eslintignore",
		"!./.editorconfig",
		"!./phpcs.xml.dist",
		"!./vscode",
		"!./package.json",
		"!./package-lock.json",
		"!./{assets,assets/**/*}",
		`!${imgSRC}`,
		`!${styleSRC}`,
		`!${styleSRCBlocks}`
	],
	BROWSERS_LIST = ["last 3 version", "> 1%"];

// Project plugins
const gulp = require("gulp"),
	sass = require("gulp-sass"),
	autoprefixer = require("gulp-autoprefixer"),
	imagemin = require("gulp-imagemin"),
	sourcemaps = require("gulp-sourcemaps"),
	notify = require("gulp-notify"),
	browserSync = require("browser-sync").create(),
	cache = require("gulp-cache"),
	plumber = require("gulp-plumber"),
	beep = require("beepbeep"),
	zip = require("gulp-zip"),
	webpack = require("webpack-stream");

// Custom Error Handler.
const errorHandler = (r) => {
	notify.onError("\n\n❌  ===> ERROR: <%= error.message %>\n")(r);
	beep();
};

// Task: `browser-sync`.
const browsersync = (done) => {
	browserSync.init({
		proxy: projectURL,
		open: browserAutoOpen,
		injectChanges: injectChanges,
		watchEvents: ["change", "add", "unlink", "addDir", "unlinkDir"]
	});
	done();
};

// Helper function to allow browser reload with Gulp 4.
const reload = (done) => {
	browserSync.reload();
	done();
};

// Task: `styles`.
gulp.task("styles", () => {
	return gulp
		.src(styleSRC, { allowEmpty: ! 0 })
		.pipe(plumber(errorHandler))
		.pipe(sourcemaps.init())
		.pipe(
			sass({
				errLogToConsole: errLogToConsole,
				outputStyle: outputStyle,
				precision: precision
			})
		)
		.pipe(autoprefixer(BROWSERS_LIST))
		.on("error", sass.logError)
		.pipe(sourcemaps.write("./"))
		.pipe(gulp.dest(styleDestination))
		.pipe(browserSync.stream())
		.pipe(notify({ message: "\n\n✅  ===> STYLES — completed!\n", onLast: ! 0 }));
});

// Task: `styles`.
gulp.task("blockStyles", () => {
	return gulp
		.src(styleSRCBlocks, { allowEmpty: ! 0 })
		.pipe(plumber(errorHandler))
		.pipe(sourcemaps.init())
		.pipe(
			sass({
				errLogToConsole: errLogToConsole,
				outputStyle: outputStyle,
				precision: precision
			})
		)
		.pipe(autoprefixer(BROWSERS_LIST))
		.on("error", sass.logError)
		.pipe(sourcemaps.write("./"))
		.pipe(gulp.dest(styleDestination))
		.pipe(browserSync.stream())
		.pipe(notify({ message: "\n\n✅  ===> BLOCK STYLES — completed!\n", onLast: ! 0 }));
});

// Task: `webpackJS`.
gulp.task("webpackJS", () => {
	return gulp
		.src(watchJsAll)
		.pipe(plumber(errorHandler))
		.pipe(webpack({ output: { filename: "bundle.js" } }))
		.pipe(gulp.dest(jsCustomDestination))
		.pipe(notify({ message: "\n\n✅  ===> WEBPACK JS — completed!\n", onLast: ! 0 }));
});

// Task: `images`.
gulp.task("images", () => {
	return gulp
		.src(imgSRC)
		.pipe(
			cache(
				imagemin([
					imagemin.gifsicle({ interlaced: ! 0 }),
					imagemin.mozjpeg({ quality: 90, progressive: ! 0 }),
					imagemin.optipng({ optimizationLevel: 3 }),
					imagemin.svgo({ plugins: [{ removeViewBox: ! 0 }, { cleanupIDs: ! 1 }] })
				])
			)
		)
		.pipe(gulp.dest(imgDST))
		.pipe(notify({ message: "\n\n✅  ===> IMAGES — completed!\n", onLast: ! 0 }));
});

// Task: `clear-images-cache`.
gulp.task("clearCache", function (done) {
	return cache.clearAll(done);
});

// Zips theme or plugin and places in the parent directory
gulp.task("zip", () => {
	const src = [...zipIncludeGlob, ...zipIgnoreGlob];
	return gulp.src(src).pipe(zip(zipName)).pipe(gulp.dest(zipDestination));
});

// Watch Tasks.
gulp.task(
	"default",
	gulp.parallel("styles", "blockStyles", "webpackJS", "images", browsersync, () => {
		gulp.watch(watchPhp, reload); // Reload on PHP file changes.
		gulp.watch(watchStyles, gulp.parallel("styles")); // Reload on SCSS file changes.
		gulp.watch(watchStyles, gulp.parallel("blockStyles")); // Reload on SCSS file changes.
		gulp.watch(watchJsAll, gulp.series("webpackJS", reload)); // Reload on customJS file changes.
		gulp.watch(imgSRC, gulp.series("images", reload)); // Reload on customJS file changes.
	})
);
