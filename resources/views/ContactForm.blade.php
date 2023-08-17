@extends('layout.master')
@section('content')
    <div class="col col-md-6" style="margin-left:30%">
        <form id="form-contact">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                    placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="col col-md-2" style="margin-top:10px">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@stop


@push('script')
    <script>
        $(document).ready(function() {
            class Contact {

                constructor() {
                    this.rules = {
                        email: {
                            presence: {
                                allowEmpty: false,
                                message: "khong duoc de trong"
                            },
                            length: {
                                minimum: 5,
                                message: "ko it hon 5 ky tu"
                            },
                            email: true
                        },
                        password: {
                            presence: {
                                allowEmpty: true,
                                message: "Mat khau khong duoc de trong"
                            },
                            length: {
                                minimum: 5
                            }
                        }
                    }

                    this.formContact = $("#form-contact");
                    this.email = $("#email");
                    this.password = $("#password");

                    this.passwordError = $("#password-error");
                    this.emailError = $("#email-error");
                }

                init() {
                    this.handleSubmit();
                }

                showFormError(errors) {

                    let defultErrors = {
                        email: '',
                        password: '',
                    }

                    defultErrors = {
                        ...defultErrors,
                        ...errors
                    };

                    Object.entries(defultErrors).forEach((error) => {

                        const key = error[0];
                        const value = error[1];

                        document.getElementById(`${key}-error`)?.remove();

                        if (value != "") {
                            $(
                            `<div class="error is-invalid" id="${key}-error">
                                ${value}
                            </div>`
                            ).insertAfter(document.getElementById(key));
                        }
                    });
                }

                formValid() {
                    const errors = validate(this.formContact, this.rules) || {};
                    const isValid = Object.keys(errors).length;
                    return {
                        errors,
                        isValid
                    };
                }

                async checkEmail({
                    retries = 2
                } = {}) {

                    try {
                        console.log(retries)
                        const res = await fetch('https://jsoplaceholder.typicode.com/todos/1');
                        return await res.json();
                    } catch (error) {
                        if (retries > 0) {
                            this.checkEmail({
                                retries: retries - 1
                            })
                        }
                    }
                }

                handleSubmit() {
                    const this1 = this;
                    this.formContact.submit(async function(e) {
                        e.preventDefault();
                        const {
                            errors,
                            isValid
                        } = this1.formValid();

                        if (isValid) {
                            this1.showFormError(errors)
                        } else {
                            this1.showFormError();
                            const result = await this1.checkEmail();
                            console.log(result);

                        }
                    })
                }
            }

            (new Contact()).init();
        })
    </script>
@endpush
