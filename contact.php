<?php
/*
Template Name: Contact me
*/
?>

<?php get_header(); ?>


<?php

$nameError = '';
$emailError = '';
$subjectError = '';
$contentText = '';
$messageError = '';

//If the form is submitted
if ( isset( $_POST['submitted'] ) ) {

	//Check to see if the honeypot captcha field was filled in
	if ( trim( $_POST['checking'] ) !== '' ) {
		$captchaError = true;
	} else {

		//Check to make sure that the name field is not empty
		if ( trim( $_POST['contactName']) === '' ) {
			$nameError = __('You forgot to enter your name.', 'radiium');
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}

		//Check to make sure sure that a valid email address is submitted
		if ( trim($_POST['email']) === '' )  {
			$emailError = __('You forgot to enter your email address.', 'radiium');
			$hasError = true;

        } else if ( !is_email( trim( $_POST['email'] ) ) ) {
			$emailError = __('You entered an invalid email address.', 'radiium');
			$hasError = true;

        } else {
			$email = trim($_POST['email']);
        }


        //Check to make sure that the subject field is not empty
		if ( trim( $_POST['contactSubject']) === '' ) {
			$subjectError = __('You forgot to enter a subject.', 'radiium');
			$hasError = true;
		} else {
			$contactSubject = trim($_POST['contactSubject']);
		}

		//Check to make sure contactMessage were entered
		if ( trim( $_POST['contactMessage'] ) === '' ) {
			$messageError = __('You forgot to enter your contactMessage.', 'radiium');
            $hasError = true;

		} else {
			if ( function_exists('stripslashes') ) {
				$contactMessage = stripslashes( trim( $_POST['contactMessage'] ) );
			} else {
				$contactMessage = trim( $_POST['contactMessage'] );
			}
		}

		//If there is no error, send the email
		if ( !isset( $hasError ) ) {

			$emailTo = 'remi.poncet@radiium.space';
			$subject = $contactSubject.' from '.$name; // 'Contact Form Submission from '.$name;
			$sendCopy = trim( $_POST['sendCopy'] );
			$body = "Name: $name \n\nEmail: $email \n\nMessage: $contactMessage";
			$headers = 'From: raddium.space <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

            // Send email
			wp_mail($emailTo, $subject, $body, $headers);

            // Send copy email to sender
			if ( $sendCopy == true ) {
				$subject = __('You emailed Your Name', 'radiium');
				$headers = __('From: Your Name <noreply@somedomain.com>', 'radiium');
				wp_mail( $email, $subject, $body, $headers );
			}

			$emailSent = true;
		}
	}
} ?>


<div class="contactFormWrapper"role="form">

    <?php
    if ( isset( $emailSent ) && $emailSent == true ) {?>
        <div class="thanks">
            <h1><?php _e('Thank you', 'radiium')?>, <?=$name;?></h1>
            <p><?php _e('Your message has been sent successfully !', 'radiium')?></p>
            <div class="returnBtn">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Return at', 'radiium')?> /home</a>
            </div>
        </div>

    <?php
    $emailSent = false;
} else { ?>

    <div class="sayHello"><?php _e('SAY HELLO!', 'radiium')?></div>

    <form action="<?php the_permalink(); ?>" method="post" class="contactForm flexCol <?php if ( isset( $hasError ) ) echo 'invalid'; ?>" <?php language_attributes(); ?>>

        <div class="formRow errorGlobal">
        <?php if ( isset( $hasError ) || isset( $captchaError ) ) { ?>
			<div class=""><?php _e('There is an error in the form !', 'radiium')?></div>
		<?php } ?>
        </div>

        <!-- Name -->
        <div class="formRow flexCol formName">
            <label for="contactName"><?php _e('Your name', 'radiium')?><span class="required">*</span></label>
            <input class="formInput bordered" type="text" name="contactName" required="" aria-required="true" value="<?php if ( isset( $_POST['contactName'] ) ) echo $_POST['contactName'];?>">
            <?php if ( $nameError != '' ) echo '<div class="error">'.$nameError.'</div>' ?>
        </div>

        <!-- Email -->
        <div class="formRow flexCol formMail">
            <label for="email"><?php _e('Your email address', 'radiium')?><span class="required">*</span></label>
            <input class="formInput bordered" type="email" name="email" required="" aria-required="true" value="<?php if ( isset( $_POST['email'] ) ) echo $_POST['email'];?>">
            <?php if ( $emailError != '' ) echo '<div class="error">'.$emailError.'</div>' ?>
        </div>

        <!-- Subject -->
        <div class="formRow flexCol formSubject">
            <label for="contactSubject"><?php _e('Subjet', 'radiium')?><span class="required">*</span></label>
            <input class="formInput bordered" type="text" name="contactSubject" required="" aria-required="true" value="<?php if ( isset( $_POST['contactSubject'] ) ) echo $_POST['contactSubject'];?>">
            <?php if ( $subjectError != '' ) echo '<div class="error">'.$subjectError.'</div>' ?>
        </div>

        <!-- Message -->
        <div class="formRow flexCol formMessage">
            <label for="contactMessage"><?php _e('Your message', 'radiium')?><span class="required">*</span></label>
            <?php
            $contentText;
            if ( isset( $_POST['contactMessage'] )) {
                if ( function_exists( 'stripslashes' ) ) {
                    $contentText = stripslashes( $_POST['contactMessage'] );
                } else {
                    $contentText = $_POST['contactMessage'];
                }
            } ?>
            <textarea class="formInput bordered" name="contactMessage" cols="40" rows="6"required="" aria-required="true" ><?php echo $contentText;?></textarea>
            <?php if ( $messageError != '' ) echo '<div class="error">'.$messageError.'</div>' ?>
        </div>

        <!-- Send copy -->
        <div class="formRow flexCol formSendCopy">
            <div class="checkbox-btn">
                <input class="formInput bordered" type="checkbox" name="sendCopy" id="sendCopy" value="true" <?php if( isset( $_POST['sendCopy'] ) && $_POST['sendCopy'] == true ) echo ' checked="checked"'; ?> />
                <label for="sendCopy"><?php _e('Send a copy', 'radiium')?></label>
            </div>
        </div>

        <!-- Submit button -->
        <div class="formRow formSubmit">
            <input id="submitted" type="hidden" name="submitted" value="true" />
            <input id="submit" class="submitBtn formInput bordered" type="submit" name="submit" value="<?php _e('Send', 'radiium')?>">
        </div>

    </form>
</div>

<?php } ?>

<?php get_footer(); ?>