<x-auth-layout>

    <!--begin::Signup Form-->
    <form class="form w-100 " novalidate="novalidate" id="kt_new_user_password_form" method="POST" enctype="multipart/form-data" action="{{ route('index.userResetPassword') }}">

    @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $user_token }}">

        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-dark fw-bolder mb-3">Update Your Password</h1>
            <!--end::Title-->
            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">This is a secure area of the application. Please confirm your password before continuing</div>
            <!--end::Subtitle=-->
        </div>
        <!--begin::Heading-->

        <!--begin::Input group-->
        <div class="fv-row mb-8 fv-plugins-icon-container" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input class="form-control bg-transparent" type="password" placeholder="Password" name="password" autocomplete="off">
                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>
                        <i class="bi bi-eye fs-2 d-none"></i>
                    </span>
                </div>
                <!--end::Input wrapper-->
                <!--begin::Meter-->
                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2 active"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                </div>
                <!--end::Meter-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Hint-->
            <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp; symbols.</div>
            <!--end::Hint-->
        </div>
        <!--end::Input group=-->
        <!--end::Input group=-->
        <div class="fv-row mb-8 fv-plugins-icon-container">
            <!--begin::Repeat Password-->
            <input placeholder="Repeat Password" name="password_confirmation" type="password" autocomplete="off" class="form-control bg-transparent">
            <!--end::Repeat Password-->
        </div>
        <!--end::Input group=-->
        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_new_user_password_submit" class="btn btn-primary">
                @include('partials.general._button-indicator')
            </button>
        </div>
        <!--end::Submit button-->
        <div></div>
    </form>
    <!--end::Signup Form-->

</x-auth-layout>

<script>
        // Class Definition
        var KTPasswordResetNewPassword = function () {
            // Elements
            var form;
            var submitButton;
            var validator;
            var passwordMeter;

            var handleForm = function (e) {
                // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                validator = FormValidation.formValidation(
                    form,
                    {
                        fields: {
                            'password': {
                                validators: {
                                    notEmpty: {
                                        message: 'The password is required'
                                    },
                                    callback: {
                                        message: 'Please enter valid password',
                                        callback: function (input) {
                                            if (input.value.length > 0) {
                                                return validatePassword();
                                            }
                                        }
                                    }
                                }
                            },
                            'password_confirmation': {
                                validators: {
                                    notEmpty: {
                                        message: 'The password confirmation is required'
                                    },
                                    identical: {
                                        compare: function () {
                                            return form.querySelector('[name="password"]').value;
                                        },
                                        message: 'The password and its confirm are not the same'
                                    }
                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger({
                                event: {
                                    password: false
                                }
                            }),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: '.fv-row',
                                eleInvalidClass: '',
                                eleValidClass: ''
                            })
                        }
                    }
                );

                submitButton.addEventListener('click', function (e) {
                    e.preventDefault();

                    validator.revalidateField('password');

                    validator.validate().then(function (status) {
                        if (status == 'Valid') {
                            // Show loading indication
                            submitButton.setAttribute('data-kt-indicator', 'on');

                            // Disable button to avoid multiple click
                            submitButton.disabled = true;

                            // Simulate ajax request
                            axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form))
                                .then(function (response) {
                                    // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                                    Swal.fire({
                                        text: "You have successfully reset your password!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function (result) {
                                        if (result.isConfirmed) {
                                            window.location.href = '/login';
                                            form.querySelector('[name="email"]').value = "";
                                            form.querySelector('[name="password"]').value = "";
                                            form.querySelector('[name="password_confirmation"]').value = "";
                                            passwordMeter.reset();  // reset password meter
                                        }
                                    });
                                })
                                .catch(function (error) {
                                    let dataMessage = error.response.data.message;
                                    let dataErrors = error.response.data.errors;

                                    for (const errorsKey in dataErrors) {
                                        if (!dataErrors.hasOwnProperty(errorsKey)) continue;
                                        dataMessage += "\r\n" + dataErrors[errorsKey];
                                    }

                                    if (error.response) {
                                        Swal.fire({
                                            text: dataMessage,
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        });
                                    }
                                })
                                .then(function () {
                                    // always executed
                                    // Hide loading indication
                                    submitButton.removeAttribute('data-kt-indicator');

                                    // Enable button
                                    submitButton.disabled = false;
                                });
                        } else {
                            // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    });
                });

                form.querySelector('input[name="password"]').addEventListener('input', function () {
                    if (this.value.length > 0) {
                        validator.updateFieldStatus('password', 'NotValidated');
                    }
                });
            }

            var validatePassword = function () {
                return (passwordMeter.getScore() > 50);
            }

            // Public Functions
            return {
                // public functions
                init: function () {
                    form = document.querySelector('#kt_new_user_password_form');
                    submitButton = document.querySelector('#kt_new_user_password_submit');
                    passwordMeter = KTPasswordMeter.getInstance(form.querySelector('[data-kt-password-meter="true"]'));

                    handleForm();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTPasswordResetNewPassword.init();
        });
</script>
