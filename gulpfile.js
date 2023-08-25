const { src, dest } = require('gulp');
const concat = require('gulp-concat');

const myBundleJS = () => {
    src([
        'resources/assets/js/*'
    ])
        .pipe(concat('script.js'))
        .pipe(dest('public/js'))
}

exports.myBundleJS = myBundleJS;
