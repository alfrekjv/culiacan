<?php $view->extend('::base.html.php'); ?>

<?php $view['slots']->start('include_css') ?>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('user/css/signup.css') ?>"/>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('css/libs/jquery-ui-1.9.1.custom.min.css') ?>"/>
<?php $view['slots']->stop(); ?>

<?php $view['slots']->start('include_js_body') ?>
<script src="<?php echo $view['assets']->getUrl('js/libs/jquery.validationEngine-en.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('js/libs/jquery.validationEngine.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('js/libs/jquery-ui-1.9.1.custom.min.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('user/js/signup.js') ?>"></script>
<?php $view['slots']->stop(); ?>

<section id="user-signup" class="clearfix well container">

    <?php if (isset($errors) && !empty($errors)): ?>
    <div class="alert alert-error">
        <?php foreach ($errors as $error): ?>
        <p><?=$view->escape($error);?></p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <form action="<?=$view['router']->generate('User_Signup_Save');?>" method="post" class="form-horizontal" enctype='multipart/form-data'>

        <legend>Profile Builder</legend>
        
        <div class="login-social clearfix">
            <p>Sign in using social network:</p>
            <div class="twitter">
                <a href="<?=$view['router']->generate('User_Social_Login', array('provider' => 'Twitter'));?>" class="btn_1">Login with Twitter</a>
            </div>
            <div class="fb">
                <a href="<?=$view['router']->generate('User_Social_Login', array('provider' => 'Facebook'));?>" class="btn_2">Login with Facebook</a>
            </div>
        </div>

        <div class="step-1">

            <div class="control-group">
                <label class="control-label" for="formFirstName">First Name <em>*</em></label>

                <div class="controls">
                    <input type="text" class="input-xlarge validate[required]" id="formFirstName" name="userFirstName" value="<?=$signupData['firstname'];?>">
                    <span rel="formFirstName" class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="formLastName">Last Name <em>*</em></label>

                <div class="controls">
                    <input type="text" class="input-xlarge validate[required]" id="formLastName" name="userLastName" value="<?=$signupData['lastname'];?>">
                    <span rel="formLastName" class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="formEmail">Email Address <em>*</em></label>

                <div class="controls">
                    <input type="text" class="input-xlarge validate[required,custom[email], funcCall[validateTakenEmail]]" id="formEmail"
                           name="userEmail" value="<?=$signupData['email'];?>">
                    <span rel="formEmail" class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="formUsername">Username <em>*</em></label>

                <div class="controls">
                    <input type="text" class="input-xlarge validate[required, funcCall[validateTakenUsername]]" id="formUsername" name="userUsername" value="<?=$signupData['username'];?>">
                    <span rel="formUsername" class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="formPassword">Password <em>*</em></label>

                <div class="controls">
                    <input type="password" class="input-xlarge validate[required]" id="formPassword"
                           name="userPassword">
                    <span rel="formPassword" class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="formConfirmPassword">Confirm Password <em>*</em></label>

                <div class="controls">
                    <input type="password" class="input-xlarge validate[required,equals[formPassword]]"
                           id="formConfirmPassword" name="userConfirmPassword">
                    <span rel="formPatientName" class="help-inline"></span>
                </div>
            </div>
            
            <div class="form-actions buttons-area">
                <input type="submit" class="btn btn-large btn-step" data-goto-step="2" value="Register Now">
            </div>

        </div>
        <!-- / Step 1 -->

        <div class="step-2">

            <div class="alert alert-info">Please fill out info below.</div>

            <!-- DOB Here -->
            <div class="control-group">
                <label class="control-label" for="formDOB">Date Of Birth</label>

                <div class="controls">
                    <input type="text" class="input-xlarge datepicker" id="formDOB" name="dob" readonly>
                    <span class="add-on"><i class="icon-calendar"></i></span>
                    <span rel="formDOB" class="help-inline"></span>
                    <input type="hidden" id="hiddenDOBData" name="userDOB" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="formPrimaryPhone">Primary Phone</label>

                <div class="controls">
                    <input type="text" class="input-xlarge" id="formPrimaryPhone"
                           name="userPrimaryPhone" value="<?=$signupData['phone'];?>">
                    <span rel="formPrimaryPhone" class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="formTwitter">Twitter Handle</label>

                <div class="controls">
                    <input type="text" class="input-xlarge" id="formTwitter" name="userTwitter" value="<?=$signupData['provider'] == 'Twitter' ? $signupData['profile_url'] : '';?>">
                    <span rel="formTwitter" class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="formFacebook">Facebook URL</label>

                <div class="controls">
                    <input type="text" class="input-xlarge" id="formFacebook" name="userFacebook" value="<?=$signupData['provider'] == 'Facebook' ? $signupData['profile_url'] : '';?>">
                    <span rel="formFacebook" class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="formPicture1">Upload Picture</label>

                <div class="controls">
                    <input type="file" class="input-xlarge" id="formPicture1" name="userPicture1">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="formPicture2">Upload Picture</label>

                <div class="controls">
                    <input type="file" class="input-xlarge" id="formPicture2" name="userPicture2">
                </div>
            </div>
            
            <div class="form-actions buttons-area">
                
                <input type="button" class="btn btn-large btn-step" data-goto-step="1" value="Go back">
                <input type="submit" class="btn btn-large" value="Build Profile">
            </div>
            
        </div>

    </form>

</section>
