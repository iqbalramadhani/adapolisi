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

/***/ "./resources/assets/core/js/custom/apps/user-management/roles/view/update-role.js":
/*!****************************************************************************************!*\
  !*** ./resources/assets/core/js/custom/apps/user-management/roles/view/update-role.js ***!
  \****************************************************************************************/
/***/ (() => {

eval("\n\n// Class definition\nvar KTUsersUpdatePermissions = function () {\n  // Shared variables\n  var element = document.getElementById('kt_modal_update_role');\n  var form = element.querySelector('#kt_modal_update_role_form');\n  var modal = new bootstrap.Modal(element);\n\n  // Init add schedule modal\n  var initUpdatePermissions = function initUpdatePermissions() {\n    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/\n    var validator = FormValidation.formValidation(form, {\n      fields: {\n        'role_name': {\n          validators: {\n            notEmpty: {\n              message: 'Role name is required'\n            }\n          }\n        }\n      },\n      plugins: {\n        trigger: new FormValidation.plugins.Trigger(),\n        bootstrap: new FormValidation.plugins.Bootstrap5({\n          rowSelector: '.fv-row',\n          eleInvalidClass: '',\n          eleValidClass: ''\n        })\n      }\n    });\n\n    // Close button handler\n    var closeButton = element.querySelector('[data-kt-roles-modal-action=\"close\"]');\n    closeButton.addEventListener('click', function (e) {\n      e.preventDefault();\n      Swal.fire({\n        text: \"Are you sure you would like to close?\",\n        icon: \"warning\",\n        showCancelButton: true,\n        buttonsStyling: false,\n        confirmButtonText: \"Yes, close it!\",\n        cancelButtonText: \"No, return\",\n        customClass: {\n          confirmButton: \"btn btn-primary\",\n          cancelButton: \"btn btn-active-light\"\n        }\n      }).then(function (result) {\n        if (result.value) {\n          modal.hide(); // Hide modal\t\t\t\t\n        }\n      });\n    });\n\n    // Cancel button handler\n    var cancelButton = element.querySelector('[data-kt-roles-modal-action=\"cancel\"]');\n    cancelButton.addEventListener('click', function (e) {\n      e.preventDefault();\n      Swal.fire({\n        text: \"Are you sure you would like to cancel?\",\n        icon: \"warning\",\n        showCancelButton: true,\n        buttonsStyling: false,\n        confirmButtonText: \"Yes, cancel it!\",\n        cancelButtonText: \"No, return\",\n        customClass: {\n          confirmButton: \"btn btn-primary\",\n          cancelButton: \"btn btn-active-light\"\n        }\n      }).then(function (result) {\n        if (result.value) {\n          form.reset(); // Reset form\t\n          modal.hide(); // Hide modal\t\t\t\t\n        } else if (result.dismiss === 'cancel') {\n          Swal.fire({\n            text: \"Your form has not been cancelled!.\",\n            icon: \"error\",\n            buttonsStyling: false,\n            confirmButtonText: \"Ok, got it!\",\n            customClass: {\n              confirmButton: \"btn btn-primary\"\n            }\n          });\n        }\n      });\n    });\n\n    // Submit button handler\n    var submitButton = element.querySelector('[data-kt-roles-modal-action=\"submit\"]');\n    submitButton.addEventListener('click', function (e) {\n      // Prevent default button action\n      e.preventDefault();\n\n      // Validate form before submit\n      if (validator) {\n        validator.validate().then(function (status) {\n          console.log('validated!');\n          if (status == 'Valid') {\n            // Show loading indication\n            submitButton.setAttribute('data-kt-indicator', 'on');\n\n            // Disable button to avoid multiple click \n            submitButton.disabled = true;\n\n            // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/\n            setTimeout(function () {\n              // Remove loading indication\n              submitButton.removeAttribute('data-kt-indicator');\n\n              // Enable button\n              submitButton.disabled = false;\n\n              // Show popup confirmation \n              Swal.fire({\n                text: \"Form has been successfully submitted!\",\n                icon: \"success\",\n                buttonsStyling: false,\n                confirmButtonText: \"Ok, got it!\",\n                customClass: {\n                  confirmButton: \"btn btn-primary\"\n                }\n              }).then(function (result) {\n                if (result.isConfirmed) {\n                  modal.hide();\n                }\n              });\n\n              //form.submit(); // Submit form\n            }, 2000);\n          } else {\n            // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/\n            Swal.fire({\n              text: \"Sorry, looks like there are some errors detected, please try again.\",\n              icon: \"error\",\n              buttonsStyling: false,\n              confirmButtonText: \"Ok, got it!\",\n              customClass: {\n                confirmButton: \"btn btn-primary\"\n              }\n            });\n          }\n        });\n      }\n    });\n  };\n\n  // Select all handler\n  var handleSelectAll = function handleSelectAll() {\n    // Define variables\n    var selectAll = form.querySelector('#kt_roles_select_all');\n    var allCheckboxes = form.querySelectorAll('[type=\"checkbox\"]');\n\n    // Handle check state\n    selectAll.addEventListener('change', function (e) {\n      // Apply check state to all checkboxes\n      allCheckboxes.forEach(function (c) {\n        c.checked = e.target.checked;\n      });\n    });\n  };\n  return {\n    // Public functions\n    init: function init() {\n      initUpdatePermissions();\n      handleSelectAll();\n    }\n  };\n}();\n\n// On document ready\nKTUtil.onDOMContentLoaded(function () {\n  KTUsersUpdatePermissions.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2NvcmUvanMvY3VzdG9tL2FwcHMvdXNlci1tYW5hZ2VtZW50L3JvbGVzL3ZpZXcvdXBkYXRlLXJvbGUuanMuanMiLCJtYXBwaW5ncyI6IkFBQWE7O0FBRWI7QUFDQSxJQUFJQSx3QkFBd0IsR0FBRyxZQUFZO0VBQ3ZDO0VBQ0EsSUFBTUMsT0FBTyxHQUFHQyxRQUFRLENBQUNDLGNBQWMsQ0FBQyxzQkFBc0IsQ0FBQztFQUMvRCxJQUFNQyxJQUFJLEdBQUdILE9BQU8sQ0FBQ0ksYUFBYSxDQUFDLDRCQUE0QixDQUFDO0VBQ2hFLElBQU1DLEtBQUssR0FBRyxJQUFJQyxTQUFTLENBQUNDLEtBQUssQ0FBQ1AsT0FBTyxDQUFDOztFQUUxQztFQUNBLElBQUlRLHFCQUFxQixHQUFHLFNBQXhCQSxxQkFBcUIsR0FBUztJQUU5QjtJQUNBLElBQUlDLFNBQVMsR0FBR0MsY0FBYyxDQUFDQyxjQUFjLENBQ3pDUixJQUFJLEVBQ0o7TUFDSVMsTUFBTSxFQUFFO1FBQ0osV0FBVyxFQUFFO1VBQ1RDLFVBQVUsRUFBRTtZQUNSQyxRQUFRLEVBQUU7Y0FDTkMsT0FBTyxFQUFFO1lBQ2I7VUFDSjtRQUNKO01BQ0osQ0FBQztNQUVEQyxPQUFPLEVBQUU7UUFDTEMsT0FBTyxFQUFFLElBQUlQLGNBQWMsQ0FBQ00sT0FBTyxDQUFDRSxPQUFPLEVBQUU7UUFDN0NaLFNBQVMsRUFBRSxJQUFJSSxjQUFjLENBQUNNLE9BQU8sQ0FBQ0csVUFBVSxDQUFDO1VBQzdDQyxXQUFXLEVBQUUsU0FBUztVQUN0QkMsZUFBZSxFQUFFLEVBQUU7VUFDbkJDLGFBQWEsRUFBRTtRQUNuQixDQUFDO01BQ0w7SUFDSixDQUFDLENBQ0o7O0lBRUQ7SUFDQSxJQUFNQyxXQUFXLEdBQUd2QixPQUFPLENBQUNJLGFBQWEsQ0FBQyxzQ0FBc0MsQ0FBQztJQUNqRm1CLFdBQVcsQ0FBQ0MsZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFVBQUFDLENBQUMsRUFBSTtNQUN2Q0EsQ0FBQyxDQUFD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RSxnQkFBWTtNQUNkdEQscUJBQXFCLEVBQUU7TUFDdkI4QyxlQUFlLEVBQUU7SUFDckI7RUFDSixDQUFDO0FBQ0wsQ0FBQyxFQUFFOztBQUVIO0FBQ0FTLE1BQU0sQ0FBQ0Msa0JBQWtCLENBQUMsWUFBWTtFQUNsQ2pFLHdCQUF3QixDQUFDK0QsSUFBSSxFQUFFO0FBQ25DLENBQUMsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9hc3NldHMvY29yZS9qcy9jdXN0b20vYXBwcy91c2VyLW1hbmFnZW1lbnQvcm9sZXMvdmlldy91cGRhdGUtcm9sZS5qcz84YTU4Il0sInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xyXG5cclxuLy8gQ2xhc3MgZGVmaW5pdGlvblxyXG52YXIgS1RVc2Vyc1VwZGF0ZVBlcm1pc3Npb25zID0gZnVuY3Rpb24gKCkge1xyXG4gICAgLy8gU2hhcmVkIHZhcmlhYmxlc1xyXG4gICAgY29uc3QgZWxlbWVudCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdrdF9tb2RhbF91cGRhdGVfcm9sZScpO1xyXG4gICAgY29uc3QgZm9ybSA9IGVsZW1lbnQucXVlcnlTZWxlY3RvcignI2t0X21vZGFsX3VwZGF0ZV9yb2xlX2Zvcm0nKTtcclxuICAgIGNvbnN0IG1vZGFsID0gbmV3IGJvb3RzdHJhcC5Nb2RhbChlbGVtZW50KTtcclxuXHJcbiAgICAvLyBJbml0IGFkZCBzY2hlZHVsZSBtb2RhbFxyXG4gICAgdmFyIGluaXRVcGRhdGVQZXJtaXNzaW9ucyA9ICgpID0+IHtcclxuXHJcbiAgICAgICAgLy8gSW5pdCBmb3JtIHZhbGlkYXRpb24gcnVsZXMuIEZvciBtb3JlIGluZm8gY2hlY2sgdGhlIEZvcm1WYWxpZGF0aW9uIHBsdWdpbidzIG9mZmljaWFsIGRvY3VtZW50YXRpb246aHR0cHM6Ly9mb3JtdmFsaWRhdGlvbi5pby9cclxuICAgICAgICB2YXIgdmFsaWRhdG9yID0gRm9ybVZhbGlkYXRpb24uZm9ybVZhbGlkYXRpb24oXHJcbiAgICAgICAgICAgIGZvcm0sXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGZpZWxkczoge1xyXG4gICAgICAgICAgICAgICAgICAgICdyb2xlX25hbWUnOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHZhbGlkYXRvcnM6IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIG5vdEVtcHR5OiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgbWVzc2FnZTogJ1JvbGUgbmFtZSBpcyByZXF1aXJlZCdcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgICAgICB9LFxyXG5cclxuICAgICAgICAgICAgICAgIHBsdWdpbnM6IHtcclxuICAgICAgICAgICAgICAgICAgICB0cmlnZ2VyOiBuZXcgRm9ybVZhbGlkYXRpb24ucGx1Z2lucy5UcmlnZ2VyKCksXHJcbiAgICAgICAgICAgICAgICAgICAgYm9vdHN0cmFwOiBuZXcgRm9ybVZhbGlkYXRpb24ucGx1Z2lucy5Cb290c3RyYXA1KHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgcm93U2VsZWN0b3I6ICcuZnYtcm93JyxcclxuICAgICAgICAgICAgICAgICAgICAgICAgZWxlSW52YWxpZENsYXNzOiAnJyxcclxuICAgICAgICAgICAgICAgICAgICAgICAgZWxlVmFsaWRDbGFzczogJydcclxuICAgICAgICAgICAgICAgICAgICB9KVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgKTtcclxuXHJcbiAgICAgICAgLy8gQ2xvc2UgYnV0dG9uIGhhbmRsZXJcclxuICAgICAgICBjb25zdCBjbG9zZUJ1dHRvbiA9IGVsZW1lbnQucXVlcnlTZWxlY3RvcignW2RhdGEta3Qtcm9sZXMtbW9kYWwtYWN0aW9uPVwiY2xvc2VcIl0nKTtcclxuICAgICAgICBjbG9zZUJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGUgPT4ge1xyXG4gICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcblxyXG4gICAgICAgICAgICBTd2FsLmZpcmUoe1xyXG4gICAgICAgICAgICAgICAgdGV4dDogXCJBcmUgeW91IHN1cmUgeW91IHdvdWxkIGxpa2UgdG8gY2xvc2U/XCIsXHJcbiAgICAgICAgICAgICAgICBpY29uOiBcIndhcm5pbmdcIixcclxuICAgICAgICAgICAgICAgIHNob3dDYW5jZWxCdXR0b246IHRydWUsXHJcbiAgICAgICAgICAgICAgICBidXR0b25zU3R5bGluZzogZmFsc2UsXHJcbiAgICAgICAgICAgICAgICBjb25maXJtQnV0dG9uVGV4dDogXCJZZXMsIGNsb3NlIGl0IVwiLFxyXG4gICAgICAgICAgICAgICAgY2FuY2VsQnV0dG9uVGV4dDogXCJObywgcmV0dXJuXCIsXHJcbiAgICAgICAgICAgICAgICBjdXN0b21DbGFzczoge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbmZpcm1CdXR0b246IFwiYnRuIGJ0bi1wcmltYXJ5XCIsXHJcbiAgICAgICAgICAgICAgICAgICAgY2FuY2VsQnV0dG9uOiBcImJ0biBidG4tYWN0aXZlLWxpZ2h0XCJcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSkudGhlbihmdW5jdGlvbiAocmVzdWx0KSB7XHJcbiAgICAgICAgICAgICAgICBpZiAocmVzdWx0LnZhbHVlKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgbW9kYWwuaGlkZSgpOyAvLyBIaWRlIG1vZGFsXHRcdFx0XHRcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIC8vIENhbmNlbCBidXR0b24gaGFuZGxlclxyXG4gICAgICAgIGNvbnN0IGNhbmNlbEJ1dHRvbiA9IGVsZW1lbnQucXVlcnlTZWxlY3RvcignW2RhdGEta3Qtcm9sZXMtbW9kYWwtYWN0aW9uPVwiY2FuY2VsXCJdJyk7XHJcbiAgICAgICAgY2FuY2VsQnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZSA9PiB7XHJcbiAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuXHJcbiAgICAgICAgICAgIFN3YWwuZmlyZSh7XHJcbiAgICAgICAgICAgICAgICB0ZXh0OiBcIkFyZSB5b3Ugc3VyZSB5b3Ugd291bGQgbGlrZSB0byBjYW5jZWw/XCIsXHJcbiAgICAgICAgICAgICAgICBpY29uOiBcIndhcm5pbmdcIixcclxuICAgICAgICAgICAgICAgIHNob3dDYW5jZWxCdXR0b246IHRydWUsXHJcbiAgICAgICAgICAgICAgICBidXR0b25zU3R5bGluZzogZmFsc2UsXHJcbiAgICAgICAgICAgICAgICBjb25maXJtQnV0dG9uVGV4dDogXCJZZXMsIGNhbmNlbCBpdCFcIixcclxuICAgICAgICAgICAgICAgIGNhbmNlbEJ1dHRvblRleHQ6IFwiTm8sIHJldHVyblwiLFxyXG4gICAgICAgICAgICAgICAgY3VzdG9tQ2xhc3M6IHtcclxuICAgICAgICAgICAgICAgICAgICBjb25maXJtQnV0dG9uOiBcImJ0biBidG4tcHJpbWFyeVwiLFxyXG4gICAgICAgICAgICAgICAgICAgIGNhbmNlbEJ1dHRvbjogXCJidG4gYnRuLWFjdGl2ZS1saWdodFwiXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0pLnRoZW4oZnVuY3Rpb24gKHJlc3VsdCkge1xyXG4gICAgICAgICAgICAgICAgaWYgKHJlc3VsdC52YWx1ZSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGZvcm0ucmVzZXQoKTsgLy8gUmVzZXQgZm9ybVx0XHJcbiAgICAgICAgICAgICAgICAgICAgbW9kYWwuaGlkZSgpOyAvLyBIaWRlIG1vZGFsXHRcdFx0XHRcclxuICAgICAgICAgICAgICAgIH0gZWxzZSBpZiAocmVzdWx0LmRpc21pc3MgPT09ICdjYW5jZWwnKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgU3dhbC5maXJlKHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgdGV4dDogXCJZb3VyIGZvcm0gaGFzIG5vdCBiZWVuIGNhbmNlbGxlZCEuXCIsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGljb246IFwiZXJyb3JcIixcclxuICAgICAgICAgICAgICAgICAgICAgICAgYnV0dG9uc1N0eWxpbmc6IGZhbHNlLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb25maXJtQnV0dG9uVGV4dDogXCJPaywgZ290IGl0IVwiLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICBjdXN0b21DbGFzczoge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29uZmlybUJ1dHRvbjogXCJidG4gYnRuLXByaW1hcnlcIixcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH0pO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgLy8gU3VibWl0IGJ1dHRvbiBoYW5kbGVyXHJcbiAgICAgICAgY29uc3Qgc3VibWl0QnV0dG9uID0gZWxlbWVudC5xdWVyeVNlbGVjdG9yKCdbZGF0YS1rdC1yb2xlcy1tb2RhbC1hY3Rpb249XCJzdWJtaXRcIl0nKTtcclxuICAgICAgICBzdWJtaXRCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xyXG4gICAgICAgICAgICAvLyBQcmV2ZW50IGRlZmF1bHQgYnV0dG9uIGFjdGlvblxyXG4gICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcblxyXG4gICAgICAgICAgICAvLyBWYWxpZGF0ZSBmb3JtIGJlZm9yZSBzdWJtaXRcclxuICAgICAgICAgICAgaWYgKHZhbGlkYXRvcikge1xyXG4gICAgICAgICAgICAgICAgdmFsaWRhdG9yLnZhbGlkYXRlKCkudGhlbihmdW5jdGlvbiAoc3RhdHVzKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29uc29sZS5sb2coJ3ZhbGlkYXRlZCEnKTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgaWYgKHN0YXR1cyA9PSAnVmFsaWQnKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC8vIFNob3cgbG9hZGluZyBpbmRpY2F0aW9uXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHN1Ym1pdEJ1dHRvbi5zZXRBdHRyaWJ1dGUoJ2RhdGEta3QtaW5kaWNhdG9yJywgJ29uJyk7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAvLyBEaXNhYmxlIGJ1dHRvbiB0byBhdm9pZCBtdWx0aXBsZSBjbGljayBcclxuICAgICAgICAgICAgICAgICAgICAgICAgc3VibWl0QnV0dG9uLmRpc2FibGVkID0gdHJ1ZTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC8vIFNpbXVsYXRlIGZvcm0gc3VibWlzc2lvbi4gRm9yIG1vcmUgaW5mbyBjaGVjayB0aGUgcGx1Z2luJ3Mgb2ZmaWNpYWwgZG9jdW1lbnRhdGlvbjogaHR0cHM6Ly9zd2VldGFsZXJ0Mi5naXRodWIuaW8vXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgLy8gUmVtb3ZlIGxvYWRpbmcgaW5kaWNhdGlvblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgc3VibWl0QnV0dG9uLnJlbW92ZUF0dHJpYnV0ZSgnZGF0YS1rdC1pbmRpY2F0b3InKTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAvLyBFbmFibGUgYnV0dG9uXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBzdWJtaXRCdXR0b24uZGlzYWJsZWQgPSBmYWxzZTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAvLyBTaG93IHBvcHVwIGNvbmZpcm1hdGlvbiBcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIFN3YWwuZmlyZSh7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgdGV4dDogXCJGb3JtIGhhcyBiZWVuIHN1Y2Nlc3NmdWxseSBzdWJtaXR0ZWQhXCIsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgaWNvbjogXCJzdWNjZXNzXCIsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgYnV0dG9uc1N0eWxpbmc6IGZhbHNlLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbmZpcm1CdXR0b25UZXh0OiBcIk9rLCBnb3QgaXQhXCIsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgY3VzdG9tQ2xhc3M6IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgY29uZmlybUJ1dHRvbjogXCJidG4gYnRuLXByaW1hcnlcIlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0pLnRoZW4oZnVuY3Rpb24gKHJlc3VsdCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmIChyZXN1bHQuaXNDb25maXJtZWQpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgbW9kYWwuaGlkZSgpO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIC8vZm9ybS5zdWJtaXQoKTsgLy8gU3VibWl0IGZvcm1cclxuICAgICAgICAgICAgICAgICAgICAgICAgfSwgMjAwMCk7XHJcbiAgICAgICAgICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgLy8gU2hvdyBwb3B1cCB3YXJuaW5nLiBGb3IgbW9yZSBpbmZvIGNoZWNrIHRoZSBwbHVnaW4ncyBvZmZpY2lhbCBkb2N1bWVudGF0aW9uOiBodHRwczovL3N3ZWV0YWxlcnQyLmdpdGh1Yi5pby9cclxuICAgICAgICAgICAgICAgICAgICAgICAgU3dhbC5maXJlKHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHRleHQ6IFwiU29ycnksIGxvb2tzIGxpa2UgdGhlcmUgYXJlIHNvbWUgZXJyb3JzIGRldGVjdGVkLCBwbGVhc2UgdHJ5IGFnYWluLlwiLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgaWNvbjogXCJlcnJvclwiLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgYnV0dG9uc1N0eWxpbmc6IGZhbHNlLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29uZmlybUJ1dHRvblRleHQ6IFwiT2ssIGdvdCBpdCFcIixcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGN1c3RvbUNsYXNzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgY29uZmlybUJ1dHRvbjogXCJidG4gYnRuLXByaW1hcnlcIlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIC8vIFNlbGVjdCBhbGwgaGFuZGxlclxyXG4gICAgY29uc3QgaGFuZGxlU2VsZWN0QWxsID0gKCkgPT4ge1xyXG4gICAgICAgIC8vIERlZmluZSB2YXJpYWJsZXNcclxuICAgICAgICBjb25zdCBzZWxlY3RBbGwgPSBmb3JtLnF1ZXJ5U2VsZWN0b3IoJyNrdF9yb2xlc19zZWxlY3RfYWxsJyk7XHJcbiAgICAgICAgY29uc3QgYWxsQ2hlY2tib3hlcyA9IGZvcm0ucXVlcnlTZWxlY3RvckFsbCgnW3R5cGU9XCJjaGVja2JveFwiXScpO1xyXG5cclxuICAgICAgICAvLyBIYW5kbGUgY2hlY2sgc3RhdGVcclxuICAgICAgICBzZWxlY3RBbGwuYWRkRXZlbnRMaXN0ZW5lcignY2hhbmdlJywgZSA9PiB7XHJcblxyXG4gICAgICAgICAgICAvLyBBcHBseSBjaGVjayBzdGF0ZSB0byBhbGwgY2hlY2tib3hlc1xyXG4gICAgICAgICAgICBhbGxDaGVja2JveGVzLmZvckVhY2goYyA9PiB7XHJcbiAgICAgICAgICAgICAgICBjLmNoZWNrZWQgPSBlLnRhcmdldC5jaGVja2VkO1xyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIC8vIFB1YmxpYyBmdW5jdGlvbnNcclxuICAgICAgICBpbml0OiBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgIGluaXRVcGRhdGVQZXJtaXNzaW9ucygpO1xyXG4gICAgICAgICAgICBoYW5kbGVTZWxlY3RBbGwoKTtcclxuICAgICAgICB9XHJcbiAgICB9O1xyXG59KCk7XHJcblxyXG4vLyBPbiBkb2N1bWVudCByZWFkeVxyXG5LVFV0aWwub25ET01Db250ZW50TG9hZGVkKGZ1bmN0aW9uICgpIHtcclxuICAgIEtUVXNlcnNVcGRhdGVQZXJtaXNzaW9ucy5pbml0KCk7XHJcbn0pOyJdLCJuYW1lcyI6WyJLVFVzZXJzVXBkYXRlUGVybWlzc2lvbnMiLCJlbGVtZW50IiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsImZvcm0iLCJxdWVyeVNlbGVjdG9yIiwibW9kYWwiLCJib290c3RyYXAiLCJNb2RhbCIsImluaXRVcGRhdGVQZXJtaXNzaW9ucyIsInZhbGlkYXRvciIsIkZvcm1WYWxpZGF0aW9uIiwiZm9ybVZhbGlkYXRpb24iLCJmaWVsZHMiLCJ2YWxpZGF0b3JzIiwibm90RW1wdHkiLCJtZXNzYWdlIiwicGx1Z2lucyIsInRyaWdnZXIiLCJUcmlnZ2VyIiwiQm9vdHN0cmFwNSIsInJvd1NlbGVjdG9yIiwiZWxlSW52YWxpZENsYXNzIiwiZWxlVmFsaWRDbGFzcyIsImNsb3NlQnV0dG9uIiwiYWRkRXZlbnRMaXN0ZW5lciIsImUiLCJwcmV2ZW50RGVmYXVsdCIsIlN3YWwiLCJmaXJlIiwidGV4dCIsImljb24iLCJzaG93Q2FuY2VsQnV0dG9uIiwiYnV0dG9uc1N0eWxpbmciLCJjb25maXJtQnV0dG9uVGV4dCIsImNhbmNlbEJ1dHRvblRleHQiLCJjdXN0b21DbGFzcyIsImNvbmZpcm1CdXR0b24iLCJjYW5jZWxCdXR0b24iLCJ0aGVuIiwicmVzdWx0IiwidmFsdWUiLCJoaWRlIiwicmVzZXQiLCJkaXNtaXNzIiwic3VibWl0QnV0dG9uIiwidmFsaWRhdGUiLCJzdGF0dXMiLCJjb25zb2xlIiwibG9nIiwic2V0QXR0cmlidXRlIiwiZGlzYWJsZWQiLCJzZXRUaW1lb3V0IiwicmVtb3ZlQXR0cmlidXRlIiwiaXNDb25maXJtZWQiLCJoYW5kbGVTZWxlY3RBbGwiLCJzZWxlY3RBbGwiLCJhbGxDaGVja2JveGVzIiwicXVlcnlTZWxlY3RvckFsbCIsImZvckVhY2giLCJjIiwiY2hlY2tlZCIsInRhcmdldCIsImluaXQiLCJLVFV0aWwiLCJvbkRPTUNvbnRlbnRMb2FkZWQiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/assets/core/js/custom/apps/user-management/roles/view/update-role.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/core/js/custom/apps/user-management/roles/view/update-role.js"]();
/******/ 	
/******/ })()
;