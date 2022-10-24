/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nSyntaxError: /Users/chiaramameli/Desktop/laravel/deliveboo/resources/js/app.js: Unexpected token (32:0)\n\n\u001b[0m \u001b[90m 30 |\u001b[39m })\u001b[33m;\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 31 |\u001b[39m require(\u001b[32m'./utilities/delete_confirmation'\u001b[39m)\u001b[33m;\u001b[39m\u001b[0m\n\u001b[0m\u001b[31m\u001b[1m>\u001b[22m\u001b[39m\u001b[90m 32 |\u001b[39m \u001b[33m<<\u001b[39m\u001b[33m<<\u001b[39m\u001b[33m<<\u001b[39m\u001b[33m<\u001b[39m \u001b[33mHEAD\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m    |\u001b[39m \u001b[31m\u001b[1m^\u001b[22m\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 33 |\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 34 |\u001b[39m \u001b[33m===\u001b[39m\u001b[33m===\u001b[39m\u001b[33m=\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 35 |\u001b[39m require(\u001b[32m'./utilities/image_preview'\u001b[39m)\u001b[33m;\u001b[39m\u001b[0m\n    at instantiate (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:72:32)\n    at constructor (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:367:12)\n    at Parser.raise (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:3706:19)\n    at Parser.unexpected (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:3744:16)\n    at Parser.parseExprAtom (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:13350:22)\n    at Parser.parseExprSubscripts (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:12875:23)\n    at Parser.parseUpdate (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:12854:21)\n    at Parser.parseMaybeUnary (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:12824:23)\n    at Parser.parseMaybeUnaryOrPrivate (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:12615:61)\n    at Parser.parseExprOps (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:12622:23)\n    at Parser.parseMaybeConditional (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:12592:23)\n    at Parser.parseMaybeAssign (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:12544:21)\n    at Parser.parseExpressionBase (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:12480:23)\n    at /Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:12474:39\n    at Parser.allowInAnd (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:14570:16)\n    at Parser.parseExpression (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:12474:17)\n    at Parser.parseStatementContent (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:15014:23)\n    at Parser.parseStatement (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:14871:17)\n    at Parser.parseBlockOrModuleBlockBody (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:15531:25)\n    at Parser.parseBlockBody (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:15522:10)\n    at Parser.parseProgram (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:14785:10)\n    at Parser.parseTopLevel (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:14772:25)\n    at Parser.parse (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:16799:10)\n    at parse (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/parser/lib/index.js:16851:38)\n    at parser (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/core/lib/parser/index.js:52:34)\n    at parser.next (<anonymous>)\n    at normalizeFile (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/core/lib/transformation/normalize-file.js:87:38)\n    at normalizeFile.next (<anonymous>)\n    at run (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/core/lib/transformation/index.js:31:50)\n    at run.next (<anonymous>)\n    at transform (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/@babel/core/lib/transform.js:29:41)\n    at transform.next (<anonymous>)\n    at step (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/gensync/index.js:261:32)\n    at /Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/gensync/index.js:273:13\n    at async.call.result.err.err (/Users/chiaramameli/Desktop/laravel/deliveboo/node_modules/gensync/index.js:223:11)");

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/chiaramameli/Desktop/laravel/deliveboo/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /Users/chiaramameli/Desktop/laravel/deliveboo/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });