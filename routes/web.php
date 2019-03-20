<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/know-more', function () {
    return view('knowmore');
});

Auth::routes();

Route::get('/', 'IndexController@index');
Route::get('/terms', 'IndexController@terms');
Route::get('/policy', 'IndexController@policy');
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('password-pending', 'Auth\ForgotPasswordController@forgotResponse');
Route::get('forgot-password', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::get('reactivate/{email}', 'Auth\LoginController@reactivate');
Route::post('closed-activate', 'Auth\LoginController@closedActivate');
Route::get('/logout', 'HomeController@logout')->name('logout')->middleware('auth');
Route::get('/activate-account', array('as' => 'activate-account', 'uses' => 'UserController@activateAccountPage'))->middleware('auth');
Route::get('/activate/{user_id}/{token}', array('as' => 'activate', 'uses' => 'UserController@activate'))->middleware('auth');
Route::get('/resend-activation', array('as' => 'resend-activation', 'uses' => 'UserController@resendActivation'))->middleware('auth');

Route::group(['middleware' => ['auth','isactive']], function(){
    Route::get('/change-password', array('as' => 'change-password', 'uses' => 'UserController@changePassword'));
    Route::get('/change-password-save', array('as' => 'change-password-save', 'uses' => 'UserController@changePasswordSave'));
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/settings', array('as' => 'settings', 'uses' => 'HomeController@settings'));
    Route::get('/deactivate', array('as' => 'settings', 'uses' => 'HomeController@deactivate'));
    Route::get('/postsignup', array('as' => 'postsignup', 'uses' => 'HomeController@postsignup'));
    Route::post('/postsignup/save', array('as' => 'postsignup', 'uses' => 'HomeController@postsignupSave'));
    Route::get('/requestresume', ['as' => 'resume.request.resume', 'uses' => 'Resume\ResumeController@requestResume']);
    Route::post('/requestresume', ['as' => 'resume.request.resume', 'uses' => 'Resume\ResumeController@requestResumeSave']);
    Route::post('/updateresumerequest', ['as' => 'resume.request.resume', 'uses' => 'Resume\ResumeController@requestResumeUpdate']);
});
Route::group(['middleware' => ['auth', 'isactive']], function(){
    Route::get('/memberlist', array('as' => 'memberlist', 'uses' => 'HomeController@memberlist'));
    Route::get('/contactlist', ['as' => 'resume.request.resume', 'uses' => 'UserController@contactlist']);
});

Route::group(['prefix' => 'user', 'middleware' => ['auth','isactive']], function(){
	Route::any('/profile-image', array('as' => 'user.upload-file', 'uses' => 'UserController@profileImage'));
	Route::any('/upload-file', array('as' => 'user.upload-file', 'uses' => 'UploadController@uploadFile'));
	Route::any('/save-profile-image', array('as' => 'user.save-profile-image', 'uses' => 'UserController@saveProfileImage'));
	Route::any('/save-crop-image', array('as' => 'user.save-crop-image', 'uses' => 'UserController@saveCropImage'));
    Route::any('/remove-image', array('as' => 'user.remove-image', 'uses' => 'UserController@imageRemove'));
    Route::post('/deactivate', array('as' => 'user.deactivate', 'uses' => 'UserController@deactivate'));
    Route::get('/deactivateresp', array('as' => 'user.deactivateresp', 'uses' => 'UserController@deactivateresp'));
});

Route::group(array('prefix' => 'update','middleware' => ['auth','isactive']), function(){
	Route::get('/', ['as' => 'update.index', 'uses' => 'Resume\UpdateController@index']);
	Route::post('/pp-check', ['as' => 'update.pp-check', 'uses' => 'Resume\UpdateController@PPCheck']);

    Route::get('/options', ['as' => 'update.update-options', 'uses' => 'Resume\UpdateController@updateOptions']);

    Route::get('/resume-title-cover-note', ['as' => 'update.resume-title', 'uses' => 'Resume\UpdateController@resumeTitle']);
    Route::post('/get-resume-title-details', ['as' => 'update.get-resume-title-details', 'uses' => 'Resume\UpdateController@getResumeTitleDetails']);
    Route::post('/resume-title-save', ['as' => 'update.resume-title.save', 'uses' => 'Resume\UpdateController@resumeTitleSave']);
    Route::post('/resume-title/remove/{id}', ['as' => 'update.resume-title.remove', 'uses' => 'Resume\UpdateController@resumeTitleRemove']);

    Route::get('/interests', ['as' => 'update.interests', 'uses' => 'Resume\UpdateController@interests']);
    Route::post('/get-interests-details', ['as' => 'update.get-interests-details', 'uses' => 'Resume\UpdateController@getInterestsDetails']);
    Route::post('/interests-save', ['as' => 'update.interests.save', 'uses' => 'Resume\UpdateController@interestsSave']);
    Route::get('/interests/remove/{id}', ['as' => 'update.interests.remove', 'uses' => 'Resume\UpdateController@interestsRemove']);

    Route::get('/contact', ['as' => 'update.contact', 'uses' => 'Resume\UpdateController@contact']);
	Route::post('/get-contact-details', ['as' => 'update.get-contact-details', 'uses' => 'Resume\UpdateController@getContactDetails']);
	Route::post('/contact-save', ['as' => 'update.contact-save', 'uses' => 'Resume\UpdateController@contactSave']);
    Route::post('/contact/remove/{id}', ['as' => 'update.contact-save', 'uses' => 'Resume\UpdateController@contactRemove']);

    Route::get('/calculate', ['as' => 'update.calculate', 'uses' => 'Resume\UpdateController@calculateExpTotal']);

	Route::get('/objective', ['as' => 'update.objective', 'uses' => 'Resume\UpdateController@objective']);
	Route::post('/get-objective-details', ['as' => 'update.get-objective-details', 'uses' => 'Resume\UpdateController@getObjectiveDetails']);
	Route::post('/objective-save', ['as' => 'update.objective-save', 'uses' => 'Resume\UpdateController@objectiveSave']);
	Route::post('/objective/remove/{id}', ['as' => 'update.objective-save', 'uses' => 'Resume\UpdateController@objectiveRemove']);

    Route::get('/current-address', ['as' => 'update.current-address', 'uses' => 'Resume\UpdateController@currentAddress']);
	Route::post('/get-current-address-details', ['as' => 'update.get-current-address-details', 'uses' => 'Resume\UpdateController@getCurrentAddressDetails']);
	Route::post('/current-address-save', ['as' => 'update.current-address-save', 'uses' => 'Resume\UpdateController@currentAddressSave']);
	Route::post('/current-address/remove/{id}', ['as' => 'update.current-address', 'uses' => 'Resume\UpdateController@currentAddressRemove']);

	Route::get('/permanent-address', ['as' => 'update.permanent-address', 'uses' => 'Resume\UpdateController@permanentAddress']);
	Route::post('/get-permanent-address-details', ['as' => 'update.get-permanent-address-details', 'uses' => 'Resume\UpdateController@getpermanentAddressDetails']);
	Route::post('/permanent-address-save', ['as' => 'update.permanent-address-save', 'uses' => 'Resume\UpdateController@permanentAddressSave']);
	Route::post('/permanent-address/remove/{id}', ['as' => 'update.permanent-address', 'uses' => 'Resume\UpdateController@permanentAddressRemove']);

    Route::get('/work', ['as' => 'update.work', 'uses' => 'Resume\UpdateController@work']);
    Route::get('/work/{id}', ['as' => 'update.work', 'uses' => 'Resume\UpdateController@work']);
    Route::post('/get-work-details', ['as' => 'update.get-work-details', 'uses' => 'Resume\UpdateController@getWorkDetails']);
    Route::post('/work-save', ['as' => 'update.work-save', 'uses' => 'Resume\UpdateController@workSave']);
    Route::post('/work/remove/{id}', ['as' => 'update.work.remove', 'uses' => 'Resume\UpdateController@workRemove']);

	Route::get('/education', ['as' => 'update.education', 'uses' => 'Resume\UpdateController@education']);
	Route::get('/education/{id}', ['as' => 'update.education', 'uses' => 'Resume\UpdateController@education']);
    Route::post('/get-education-details', ['as' => 'update.get-education-details', 'uses' => 'Resume\UpdateController@getEducationDetails']);
    Route::post('/education-save', ['as' => 'update.education-save', 'uses' => 'Resume\UpdateController@educationSave']);
    Route::post('/education/remove/{id}', ['as' => 'update.education.remove', 'uses' => 'Resume\UpdateController@educationRemove']);

    Route::get('/project', ['as' => 'update.project', 'uses' => 'Resume\UpdateController@project']);
	Route::get('/project/{id}', ['as' => 'update.project', 'uses' => 'Resume\UpdateController@project']);
    Route::post('/get-project-details', ['as' => 'update.get-project-details', 'uses' => 'Resume\UpdateController@getProjectDetails']);
    Route::post('/project-save', ['as' => 'update.project-save', 'uses' => 'Resume\UpdateController@projectSave']);
    Route::post('/project/remove/{id}', ['as' => 'update.project.remove', 'uses' => 'Resume\UpdateController@projectRemove']);


    Route::get('/skill', ['as' => 'update.skill', 'uses' => 'Resume\UpdateController@skill']);
	Route::get('/skill/{id}', ['as' => 'update.skill', 'uses' => 'Resume\UpdateController@skill']);
    Route::post('/get-skill-details', ['as' => 'update.get-skill-details', 'uses' => 'Resume\UpdateController@getSkillDetails']);
    Route::post('/skill-save', ['as' => 'update.skill-save', 'uses' => 'Resume\UpdateController@skillSave']);
    Route::post('/skill/remove/{id}', ['as' => 'update.skill-save', 'uses' => 'Resume\UpdateController@skillRemove']);

    Route::post('/update-new-skill', ['as' => 'update.update-new-skill', 'uses' => 'Resume\UpdateController@updateNewSkill']);

    Route::get('/soft-skill', ['as' => 'update.softskill', 'uses' => 'Resume\UpdateController@softskill']);
    Route::get('/soft-skill/{id}', ['as' => 'update.softskill', 'uses' => 'Resume\UpdateController@softskill']);
    Route::post('/get-soft-skill-details', ['as' => 'update.get-soft-skill-details', 'uses' => 'Resume\UpdateController@getSoftSkillDetails']);
    Route::post('/soft-skill-save', ['as' => 'update.softskill-save', 'uses' => 'Resume\UpdateController@softskillSave']);
    Route::post('/soft-skill/remove/{id}', ['as' => 'update.softskill-save', 'uses' => 'Resume\UpdateController@softskillRemove']);


	Route::get('/certification', ['as' => 'update.certification', 'uses' => 'Resume\UpdateController@certification']);
	Route::get('/certification/{id}', ['as' => 'update.certification', 'uses' => 'Resume\UpdateController@certification']);
    Route::post('/get-certification-details', ['as' => 'update.get-certification-details', 'uses' => 'Resume\UpdateController@getCertificationDetails']);
    Route::post('/certification-save', ['as' => 'update.certification-save', 'uses' => 'Resume\UpdateController@certificationSave']);
    Route::post('/certification/remove/{id}', ['as' => 'update.certification-save', 'uses' => 'Resume\UpdateController@certificationRemove']);

    Route::get('/training', ['as' => 'update.training', 'uses' => 'Resume\UpdateController@training']);
	Route::get('/training/{id}', ['as' => 'update.training', 'uses' => 'Resume\UpdateController@training']);
    Route::post('/get-training-details', ['as' => 'update.get-training-details', 'uses' => 'Resume\UpdateController@getTrainingDetails']);
    Route::post('/training-save', ['as' => 'update.training-save', 'uses' => 'Resume\UpdateController@trainingSave']);
    Route::post('/training/remove/{id}', ['as' => 'update.training-remove', 'uses' => 'Resume\UpdateController@trainingRemove']);

    Route::get('/course', ['as' => 'update.course', 'uses' => 'Resume\UpdateController@course']);
    Route::get('/course/{id}', ['as' => 'update.course', 'uses' => 'Resume\UpdateController@course']);
    Route::post('/get-course-details', ['as' => 'update.get-course-details', 'uses' => 'Resume\UpdateController@getCourseDetails']);
    Route::post('/course-save', ['as' => 'update.course-save', 'uses' => 'Resume\UpdateController@courseSave']);
    Route::post('/course/remove/{id}', ['as' => 'update.course-remove', 'uses' => 'Resume\UpdateController@courseRemove']);

    Route::get('/miscellaneous', ['as' => 'update.travel', 'uses' => 'Resume\UpdateController@travel']);
    Route::get('/miscellaneous/{id}', ['as' => 'update.travel', 'uses' => 'Resume\UpdateController@travel']);
    Route::post('/get-travel-details', ['as' => 'update.get-travel-details', 'uses' => 'Resume\UpdateController@getTravelDetails']);
    Route::post('/travel-save', ['as' => 'update.travel-save', 'uses' => 'Resume\UpdateController@travelSave']);
    Route::post('/travel/remove/{id}', ['as' => 'update.travel-remove', 'uses' => 'Resume\UpdateController@travelRemove']);

    Route::get('/award', ['as' => 'update.award', 'uses' => 'Resume\UpdateController@award']);
    Route::get('/award/{id}', ['as' => 'update.award', 'uses' => 'Resume\UpdateController@award']);
    Route::post('/get-award-details', ['as' => 'update.get-award-details', 'uses' => 'Resume\UpdateController@getAwardDetails']);
    Route::post('/award-save', ['as' => 'update.award-save', 'uses' => 'Resume\UpdateController@awardSave']);
    Route::post('/award/remove/{id}', ['as' => 'update.award-remove', 'uses' => 'Resume\UpdateController@awardRemove']);

    Route::get('/patent', ['as' => 'update.patent', 'uses' => 'Resume\UpdateController@patent']);
    Route::get('/patent/{id}', ['as' => 'update.patent', 'uses' => 'Resume\UpdateController@patent']);
    Route::post('/get-patent-details', ['as' => 'update.get-patent-details', 'uses' => 'Resume\UpdateController@getPatentDetails']);
    Route::post('/patent-save', ['as' => 'update.patent-save', 'uses' => 'Resume\UpdateController@patentSave']);
    Route::post('/patent/remove/{id}', ['as' => 'update.patent-remove', 'uses' => 'Resume\UpdateController@patentRemove']);

    Route::get('/language', ['as' => 'update.language', 'uses' => 'Resume\UpdateController@language']);
    Route::get('/language/{id}', ['as' => 'update.language', 'uses' => 'Resume\UpdateController@language']);
    Route::post('/get-language-details', ['as' => 'update.get-language-details', 'uses' => 'Resume\UpdateController@getLanguageDetails']);
    Route::post('/language-save', ['as' => 'update.language-save', 'uses' => 'Resume\UpdateController@languageSave']);
    Route::post('/language/remove/{id}', ['as' => 'update.language-remove', 'uses' => 'Resume\UpdateController@languageRemove']);

    Route::get('/reference', ['as' => 'update.reference', 'uses' => 'Resume\UpdateController@reference']);
    Route::get('/reference/{id}', ['as' => 'update.reference', 'uses' => 'Resume\UpdateController@reference']);
    Route::post('/get-reference-details', ['as' => 'update.get-reference-details', 'uses' => 'Resume\UpdateController@getReferenceDetails']);
    Route::post('/reference-save', ['as' => 'update.reference-save', 'uses' => 'Resume\UpdateController@referenceSave']);
    Route::post('/reference/remove/{id}', ['as' => 'update.reference-remove', 'uses' => 'Resume\UpdateController@referenceRemove']);

    Route::get('/create-date', ['as' => 'update.create-date', 'uses' => 'Resume\UpdateController@createDate']);
    Route::get('/date-diffrence', ['as' => 'update.date-diffrence', 'uses' => 'Resume\UpdateController@dateDiffrence']);

    Route::get('/passkey', ['as' => 'update.passkey', 'uses' => 'Resume\UpdateController@passkey']);
    Route::post('/change/passcode', ['as' => 'update.change-passcode', 'uses' => 'Resume\UpdateController@changePasscode']);

});

Route::group(array('prefix' => 'resume','middleware' => ['auth','isactive']), function(){
    Route::get('/', ['as' => 'resume', 'uses' => 'Resume\ResumeController@index']);
    Route::get('/view', ['as' => 'resume.view', 'uses' => 'Resume\ResumeController@view']);
    Route::post('/save', ['as' => 'resume.view', 'uses' => 'Resume\ResumeController@view']);
    Route::post('/save-share-data', ['as' => 'resume.save-share-data', 'uses' => 'Resume\ResumeController@saveShareData']);

    Route::get('/send', ['as' => 'resume.send', 'uses' => 'Resume\ResumeController@send']);
    Route::post('/send-save', ['as' => 'resume.send-save', 'uses' => 'Resume\ResumeController@sendSave']);
    Route::get('/get-share-data', ['as' => 'resume.get-share-data', 'uses' => 'Resume\ResumeController@getShareData']);
    Route::get('/download', ['as' => 'resume.download', 'uses' => 'Resume\ResumeController@download']);
    Route::get('/download-doc', ['as' => 'resume.download-doc', 'uses' => 'Resume\ResumeController@downloadDoc']);
    Route::get('/print', ['as' => 'resume.download-doc', 'uses' => 'Resume\ResumeController@printPreview']);
    Route::get('/track', ['as' => 'resume.track', 'uses' => 'Resume\ResumeController@track']);
    Route::get('/{id}', ['as' => 'resume', 'uses' => 'Resume\ResumeController@resume']);
    Route::post('/activity/update', ['as' => 'resume.activity.update', 'uses' => 'Resume\ResumeController@updateActivity']);
    Route::post('/activity/viewresume', ['as' => 'resume.activity.viewresume', 'uses' => 'Resume\ResumeController@viewResumeActivity']);
    Route::get('/forwardresume/{id}', ['as' => 'resume.forwardresume', 'uses' => 'Resume\ResumeController@forwardResume']);
    Route::post('/forwardresume', ['as' => 'resume.forwardresume', 'uses' => 'Resume\ResumeController@forwardResumeSave']);
    Route::post('/invite', ['as' => 'resume.invite', 'uses' => 'Resume\ResumeController@inviteUser']);

});
//resume view with passcode
Route::get('wm/{id}/{passcode?}', ['as' => 'resume', 'uses' => 'Resume\ResumeController@resumeView']);
Route::post('resume/verify-passcode', ['as' => 'verify.passcode', 'uses' => 'Resume\ResumeController@verifyPasscode']);
