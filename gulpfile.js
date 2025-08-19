const { src, dest, watch, series, parallel } = require('../bienesraices_inicio/node_modules/gulp');
const sass = require('../bienesraices_inicio/node_modules/gulp-sass')(require('sass'));
const autoprefixer = require('autoprefixer');
const postcss = require('../bienesraices_inicio/node_modules/gulp-postcss')
const sourcemaps = require('../bienesraices_inicio/node_modules/gulp-sourcemaps')
const cssnano = require('cssnano');
const concat = require('../bienesraices_inicio/node_modules/gulp-concat');
const terser = require('../bienesraices_inicio/node_modules/gulp-terser-js');
const rename = require('../bienesraices_inicio/node_modules/gulp-rename');
const imagemin = require('../bienesraices_inicio/node_modules/gulp-imagemin'); // Minificar imagenes 
const notify = require('../bienesraices_inicio/node_modules/gulp-notify');
const cache = require('../bienesraices_inicio/node_modules/gulp-cache');
const clean = require('../bienesraices_inicio/node_modules/gulp-clean');
const webp = require('../bienesraices_inicio/node_modules/gulp-webp');

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*'
}

function css() {
    return src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        // .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('build/css'));
}

function javascript() {
    return src(paths.js)
      .pipe(sourcemaps.init())
      .pipe(concat('bundle.js'))
      .pipe(terser())
      .pipe(sourcemaps.write('.'))
      .pipe(rename({ suffix: '.min' }))
      .pipe(dest('./build/js'))
}

function imagenes() {
    return src(paths.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3 })))
        .pipe(dest('build/img'))
        .pipe(notify('Imagen Completada' ));
}

function versionWebp() {
    return src(paths.imagenes)
        .pipe(webp())
        .pipe(dest('build/img'))
        .pipe(notify({ message: 'Imagen Completada' }));
}


function watchArchivos() {
    watch(paths.scss, css);
    watch(paths.js, javascript);
    watch(paths.imagenes, imagenes);
    watch(paths.imagenes, versionWebp);
}

exports.css = css;
exports.watchArchivos = watchArchivos;
exports.default = parallel(css, javascript, imagenes, versionWebp, watchArchivos); 