/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/core/js/custom/documentation/general/jstree/ajax.js":
/*!******************************************************************************!*\
  !*** ./resources/assets/core/js/custom/documentation/general/jstree/ajax.js ***!
  \******************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar KTJSTreeAjax = function () {\n  // Private functions\n  var exampleAjax = function exampleAjax() {\n    $(\"#kt_docs_jstree_ajax\").jstree({\n      \"core\": {\n        \"themes\": {\n          \"responsive\": false\n        },\n        // so that create works\n        \"check_callback\": true,\n        'data': {\n          'url': function url(node) {\n            return 'https://preview.keenthemes.com/api/jstree/ajax_data.php'; // Demo API endpoint -- Replace this URL with your set endpoint\n          },\n\n          'data': function data(node) {\n            return {\n              'parent': node.id\n            };\n          }\n        }\n      },\n      \"types\": {\n        \"default\": {\n          \"icon\": \"fa fa-folder text-primary\"\n        },\n        \"file\": {\n          \"icon\": \"fa fa-file  text-primary\"\n        }\n      },\n      \"state\": {\n        \"key\": \"demo3\"\n      },\n      \"plugins\": [\"dnd\", \"state\", \"types\"]\n    });\n  };\n  return {\n    // Public Functions\n    init: function init() {\n      exampleAjax();\n    }\n  };\n}();\n\n// On document ready\nKTUtil.onDOMContentLoaded(function () {\n  KTJSTreeAjax.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2RvY3VtZW50YXRpb24vZ2VuZXJhbC9qc3RyZWUvYWpheC5qcy5qcyIsIm1hcHBpbmdzIjoiQUFBYTs7QUFFYjtBQUNBLElBQUlBLFlBQVksR0FBRyxZQUFXO0VBQzFCO0VBQ0EsSUFBSUMsV0FBVyxHQUFHLFNBQWRBLFdBQVcsR0FBYztJQUN6QkMsQ0FBQyxDQUFDLHNCQUFzQixDQUFDLENBQUNDLE1BQU0sQ0FBQztNQUM3QixNQUFNLEVBQUU7UUFDSixRQUFRLEVBQUU7VUFDTixZQUFZLEVBQUU7UUFDbEIsQ0FBQztRQUNEO1FBQ0EsZ0JBQWdCLEVBQUUsSUFBSTtRQUN0QixNQUFNLEVBQUU7VUFDSixLQUFLLEVBQUUsYUFBU0MsSUFBSSxFQUFFO1lBQ2xCLE9BQU8seURBQXlELENBQUMsQ0FBQztVQUN0RSxDQUFDOztVQUNELE1BQU0sRUFBRSxjQUFTQSxJQUFJLEVBQUU7WUFDbkIsT0FBTztjQUNILFFBQVEsRUFBRUEsSUFBSSxDQUFDQztZQUNuQixDQUFDO1VBQ0w7UUFDSjtNQUNKLENBQUM7TUFDRCxPQUFPLEVBQUU7UUFDTCxTQUFTLEVBQUU7VUFDUCxNQUFNLEVBQUU7UUFDWixDQUFDO1FBQ0QsTUFBTSxFQUFFO1VBQ0osTUFBTSxFQUFFO1FBQ1o7TUFDSixDQUFDO01BQ0QsT0FBTyxFQUFFO1FBQ0wsS0FBSyxFQUFFO01BQ1gsQ0FBQztNQUNELFNBQVMsRUFBRSxDQUFDLEtBQUssRUFBRSxPQUFPLEVBQUUsT0FBTztJQUN2QyxDQUFDLENBQUM7RUFDTixDQUFDO0VBRUQsT0FBTztJQUNIO0lBQ0FDLElBQUksRUFBRSxnQkFBVztNQUNiTCxXQUFXLEVBQUU7SUFDakI7RUFDSixDQUFDO0FBQ0wsQ0FBQyxFQUFFOztBQUVIO0FBQ0FNLE1BQU0sQ0FBQ0Msa0JBQWtCLENBQUMsWUFBVztFQUNqQ1IsWUFBWSxDQUFDTSxJQUFJLEVBQUU7QUFDdkIsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2Fzc2V0cy9jb3JlL2pzL2N1c3RvbS9kb2N1bWVudGF0aW9uL2dlbmVyYWwvanN0cmVlL2FqYXguanM/ZWI2ZiJdLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIEtUSlNUcmVlQWpheCA9IGZ1bmN0aW9uKCkge1xyXG4gICAgLy8gUHJpdmF0ZSBmdW5jdGlvbnNcclxuICAgIHZhciBleGFtcGxlQWpheCA9IGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICQoXCIja3RfZG9jc19qc3RyZWVfYWpheFwiKS5qc3RyZWUoe1xyXG4gICAgICAgICAgICBcImNvcmVcIjoge1xyXG4gICAgICAgICAgICAgICAgXCJ0aGVtZXNcIjoge1xyXG4gICAgICAgICAgICAgICAgICAgIFwicmVzcG9uc2l2ZVwiOiBmYWxzZVxyXG4gICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgIC8vIHNvIHRoYXQgY3JlYXRlIHdvcmtzXHJcbiAgICAgICAgICAgICAgICBcImNoZWNrX2NhbGxiYWNrXCI6IHRydWUsXHJcbiAgICAgICAgICAgICAgICAnZGF0YSc6IHtcclxuICAgICAgICAgICAgICAgICAgICAndXJsJzogZnVuY3Rpb24obm9kZSkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gJ2h0dHBzOi8vcHJldmlldy5rZWVudGhlbWVzLmNvbS9hcGkvanN0cmVlL2FqYXhfZGF0YS5waHAnOyAvLyBEZW1vIEFQSSBlbmRwb2ludCAtLSBSZXBsYWNlIHRoaXMgVVJMIHdpdGggeW91ciBzZXQgZW5kcG9pbnRcclxuICAgICAgICAgICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICAgICAgICAgICdkYXRhJzogZnVuY3Rpb24obm9kZSkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4ge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJ3BhcmVudCc6IG5vZGUuaWRcclxuICAgICAgICAgICAgICAgICAgICAgICAgfTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIFwidHlwZXNcIjoge1xyXG4gICAgICAgICAgICAgICAgXCJkZWZhdWx0XCI6IHtcclxuICAgICAgICAgICAgICAgICAgICBcImljb25cIjogXCJmYSBmYS1mb2xkZXIgdGV4dC1wcmltYXJ5XCJcclxuICAgICAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgICAgICBcImZpbGVcIjoge1xyXG4gICAgICAgICAgICAgICAgICAgIFwiaWNvblwiOiBcImZhIGZhLWZpbGUgIHRleHQtcHJpbWFyeVwiXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIFwic3RhdGVcIjoge1xyXG4gICAgICAgICAgICAgICAgXCJrZXlcIjogXCJkZW1vM1wiXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIFwicGx1Z2luc1wiOiBbXCJkbmRcIiwgXCJzdGF0ZVwiLCBcInR5cGVzXCJdXHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgcmV0dXJuIHtcclxuICAgICAgICAvLyBQdWJsaWMgRnVuY3Rpb25zXHJcbiAgICAgICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIGV4YW1wbGVBamF4KCk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxufSgpO1xyXG5cclxuLy8gT24gZG9jdW1lbnQgcmVhZHlcclxuS1RVdGlsLm9uRE9NQ29udGVudExvYWRlZChmdW5jdGlvbigpIHtcclxuICAgIEtUSlNUcmVlQWpheC5pbml0KCk7XHJcbn0pO1xyXG4iXSwibmFtZXMiOlsiS1RKU1RyZWVBamF4IiwiZXhhbXBsZUFqYXgiLCIkIiwianN0cmVlIiwibm9kZSIsImlkIiwiaW5pdCIsIktUVXRpbCIsIm9uRE9NQ29udGVudExvYWRlZCJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/assets/core/js/custom/documentation/general/jstree/ajax.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/js/custom/documentation/general/jstree/ajax.js"]();
/******/ 	
/******/ })()
;