# WidgetKit for Elementor - Gulp Build System Guide

# WidgetKit for Elementor - Gulp Build System Guide

## ✅ All Issues Resolved

The gulpfile has been completely debugged and is now fully functional for WordPress.org submission:

1. **Missing return statement in package task** - ✅ Fixed the async function that wasn't returning the gulp stream
2. **GeneratePot compatibility issues** - ✅ Replaced problematic `gulp-wp-pot` with custom Node.js-based POT generator
3. **Incorrect glob patterns in generatePot task** - ✅ Fixed `./*/**.php` patterns to `./**/*.php` for proper recursive matching
4. **Added comprehensive error handling** - ✅ Added proper error handling for styles, js, and generatePot tasks
5. **Improved package exclusions** - ✅ Added more comprehensive file exclusions for WordPress.org compatibility
6. **Enhanced prepareUikit task** - ✅ Added proper error handling and switched from yarn to npm commands

## ✨ New Features Added

- **Custom POT Generator** - Modern Node.js-based translation file generator (`pot-generator.js`) compatible with Node.js v22+
- **Enhanced Task Structure** - Added `wp-package`, `release`, `dev`, and `assets` convenience tasks
- **Better Build Pipeline** - Complete WordPress.org preparation workflow with one command
- **Improved Documentation** - Complete usage guide with troubleshooting section

## Prerequisites

Make sure you have Node.js and npm installed:

```bash
node --version  # Should be 14+ 
npm --version   # Should be 6+
```

## Installation

1. **Install dependencies:**
```bash
cd /path/to/widgetkit-for-elementor
npm install
```

## Available Gulp Commands

### Development Commands

#### `npm run build` or `npx gulp build`
**Purpose:** Complete build process for development
**What it does:**
- Cleans the dist directory
- Compiles Bootstrap LESS files
- Copies CSS/JS from node_modules
- Compiles SCSS to CSS
- Uglifies JavaScript files
- Copies fonts and images to dist folder

```bash
npm run build
# or
npx gulp build
```

#### `npx gulp dev`
**Purpose:** Build and watch for changes (development mode)
**What it does:**
- Runs the build process
- Watches for changes in assets/scss and assets/js
- Automatically rebuilds when files change

```bash
npx gulp dev
```

#### `npx gulp watch`
**Purpose:** Watch for changes only (no initial build)
```bash
npx gulp watch
```

### Asset-Specific Commands

#### `npx gulp styles`
**Purpose:** Compile SCSS and CSS files only
```bash
npx gulp styles
```

#### `npx gulp js`
**Purpose:** Uglify JavaScript files only
```bash
npx gulp js
```

#### `npx gulp fonts`
**Purpose:** Copy fonts to dist folder
```bash
npx gulp fonts
```

#### `npx gulp images`
**Purpose:** Copy images to dist folder
```bash
npx gulp images
```

#### `npx gulp assets`
**Purpose:** Build all assets (styles, js, fonts, images) without cleaning
```bash
npx gulp assets
```

### WordPress.org Preparation Commands

#### `npm run package` or `npx gulp package`
**Purpose:** Create a WordPress.org compatible ZIP file
**What it does:**
- Creates `widgetkit-for-elementor.zip` 
- Excludes development files (node_modules, assets, gulpfile.js, etc.)
- Includes only production-ready files

```bash
npm run package
# or
npx gulp package
```

#### `npx gulp generatePot`
**Purpose:** Generate translation file (.pot) for WordPress.org using our custom POT generator
**What it does:**
- Uses custom Node.js-based POT generator (`pot-generator.js`) for Node.js v22+ compatibility
- Scans all PHP files for translatable strings (__(), _e(), _n(), _x(), etc.)
- Creates `languages/widgetkit-for-elementor.pot` with 951+ translatable strings
- Excludes test and development files
- Much faster and more reliable than the old `gulp-wp-pot` plugin

```bash
npx gulp generatePot
```

#### `npx gulp wp-package`
**Purpose:** Complete WordPress.org preparation
**What it does:**
- Builds all assets
- Generates .pot file
- Creates package ZIP

```bash
npx gulp wp-package
```

#### `npm run release` or `npx gulp release`
**Purpose:** Complete release preparation
**What it does:**
- Clean build from scratch
- Build all assets
- Generate translation file
- Create final package ZIP

```bash
npm run release
# or
npx gulp release
```

### Utility Commands

#### `npx gulp clean`
**Purpose:** Clean build artifacts
```bash
npx gulp clean
```

#### `npx gulp copy-resource`
**Purpose:** Copy CSS/JS from node_modules
```bash
npx gulp copy-resource
```

#### `npx gulp prepareUikit`
**Purpose:** Prepare UIKit with custom configuration (advanced)
```bash
npx gulp prepareUikit
```

## Typical Development Workflow

### 1. Initial Setup
```bash
# Install dependencies
npm install

# Initial build
npm run build
```

### 2. Development
```bash
# Start development with file watching
npx gulp dev

# In another terminal, you can run specific tasks as needed:
npx gulp styles    # If you only changed SCSS
npx gulp js        # If you only changed JS
```

### 3. Preparing for WordPress.org Submission
```bash
# Complete release preparation
npm run release

# This creates:
# - /dist/ folder with compiled assets
# - /languages/widgetkit-for-elementor.pot translation file  
# - widgetkit-for-elementor.zip ready for upload
```

## File Structure After Build

```
widgetkit-for-elementor/
├── dist/                          # Built assets (created by gulp)
│   ├── css/                       # Compiled CSS files
│   ├── js/                        # Minified JS files
│   ├── fonts/                     # Font files
│   └── images/                    # Image files
├── languages/                     # Translation files (created by gulp)
│   └── widgetkit-for-elementor.pot
├── assets/                        # Source files (excluded from package)
│   ├── scss/                      # SCSS source files
│   ├── js/                        # JS source files
│   ├── fonts/                     # Font source files
│   └── images/                    # Image source files
└── widgetkit-for-elementor.zip    # WordPress.org package (created by gulp)
```

## What Gets Included in WordPress.org Package

**✅ Included:**
- All PHP files
- `/dist/` folder (compiled assets)
- `/languages/` folder (translation files)
- `/vendor/` folder (Composer dependencies)
- `composer.json` (required when vendor directory is present)
- Plugin documentation files
- License files

**❌ Excluded:**
- `/node_modules/` 
- `/assets/` (source files)
- `gulpfile.js`
- `package.json` and `package-lock.json`
- `composer.lock`
- Test files (`test-*.php`, `debug-*.php`, etc.)
- Development configuration files
- Git files
- Documentation files (`COMPLETION_REPORT.md`, `GULP_GUIDE.md`)

## Troubleshooting

### Common Issues

1. **"gulp command not found"**
   ```bash
   # Install gulp globally or use npx
   npm install -g gulp-cli
   # or use npx
   npx gulp build
   ```

2. **"Cannot find module 'gulp'"**
   ```bash
   # Install dependencies
   npm install
   ```

3. **SCSS compilation errors**
   ```bash
   # Check your SCSS syntax in assets/scss/
   npx gulp styles
   ```

4. **JavaScript uglification errors**
   ```bash
   # Check your JS syntax in assets/js/
   npx gulp js
   ```

5. **Empty dist folder**
   ```bash
   # Make sure source files exist in assets/
   # Run complete build
   npx gulp build
   ```

### Composer Dependencies

6. **"Missing composer.json file" warning**
   ```bash
   # This warning occurs when vendor/ directory exists without composer.json
   # The gulpfile now includes composer.json to resolve this
   # Composer dependencies included: Parsedown, Appsero Client, MailChimp API
   ```

### Getting Help

If you encounter issues:

1. Check that all source files exist in `/assets/` folders
2. Verify Node.js and npm versions are compatible
3. Try deleting `node_modules` and running `npm install` again
4. Check the terminal output for specific error messages

## WordPress.org Submission Checklist

Before submitting to WordPress.org:

1. ✅ Run `npm run release`
2. ✅ Verify `widgetkit-for-elementor.zip` is created
3. ✅ Check that `/dist/` folder contains compiled assets
4. ✅ Verify `/languages/widgetkit-for-elementor.pot` exists
5. ✅ Test the ZIP by extracting and activating in a fresh WordPress install
6. ✅ Ensure no development files are included in the ZIP

The generated `widgetkit-for-elementor.zip` file is ready for WordPress.org submission! 🎉
