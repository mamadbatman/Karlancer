1. docker-compose up -d --build
2. docker exec laravel-app composer install
3. docker exec laravel-app php artisan migrate
4. docker exec laravel-app php artisan test



PASS  Tests\Unit\ExampleTest
✓ that true is true

WARN  Tests\Feature\ApiTokenPermissionsTest
- api token permissions can be updated → API support is not enabled.   0.58s

PASS  Tests\Feature\AuthenticationTest
✓ login screen can be rendered                                         0.09s  
✓ users can authenticate using the login screen                        0.28s  
✓ users can not authenticate with invalid password                     0.13s

PASS  Tests\Feature\BrowserSessionsTest
✓ other browser sessions can be logged out                             0.25s

WARN  Tests\Feature\CreateApiTokenTest
- api tokens can be created → API support is not enabled.              0.02s

PASS  Tests\Feature\DeleteAccountTest
✓ user accounts can be deleted                                         0.14s  
✓ correct password must be provided before account can be deleted      0.23s

WARN  Tests\Feature\DeleteApiTokenTest
- api tokens can be deleted → API support is not enabled.              0.02s

WARN  Tests\Feature\EmailVerificationTest
- email verification screen can be rendered → Email verification not…  0.02s
- email can be verified → Email verification not enabled.              0.02s
- email can not verified with invalid hash → Email verification not e… 0.02s

PASS  Tests\Feature\ExampleTest
✓ the application returns a successful response                        0.02s

PASS  Tests\Feature\PasswordConfirmationTest
✓ confirm password screen can be rendered                              0.04s  
✓ password can be confirmed                                            0.13s  
✓ password is not confirmed with invalid password                      0.23s

PASS  Tests\Feature\PasswordResetTest
✓ reset password link screen can be rendered                           0.02s  
✓ reset password link can be requested                                 0.04s  
✓ reset password screen can be rendered                                0.03s  
✓ password can be reset with valid token                               0.04s

PASS  Tests\Feature\ProfileInformationTest
✓ profile information can be updated                                   0.04s

WARN  Tests\Feature\RegistrationTest
✓ registration screen can be rendered                                  0.02s
- registration screen cannot be rendered if support is disabled → Reg… 0.02s  
  ✓ new users can register                                               0.02s

PASS  Tests\Feature\TaskTest
✓ it should list all tasks                                             0.04s  
✓ it should show a single task                                         0.02s  
✓ it should create a task                                              0.03s  
✓ it should update a task                                              0.03s  
✓ it should delete a task                                              0.03s

PASS  Tests\Feature\TwoFactorAuthenticationSettingsTest
✓ two factor authentication can be enabled                             0.03s  
✓ recovery codes can be regenerated                                    0.03s  
✓ two factor authentication can be disabled                            0.03s

PASS  Tests\Feature\UpdatePasswordTest
✓ password can be updated                                              0.14s  
✓ current password must be correct                                     0.24s  
✓ new passwords must match                                             0.24s

Tests:    7 skipped, 29 passed (49 assertions)
Duration: 3.41s
