<?php
/*
Template Name: Login Page
*/

// 1. Redirect if already logged in
if ( is_user_logged_in() ) {
    wp_redirect( home_url() );
    exit;
}

get_header(); 
?>

<div class="auth-container">
    
    <a href="<?php echo home_url(); ?>" class="back-link">
        <i class="fa fa-arrow-left"></i> 뒤로
    </a>

    <div class="auth-logo">
        <div class="logo-box"><?php bloginfo( 'name' ); ?></div>
    </div>

<<<<<<< HEAD
<?php
// Handle login errors
$login_errors = array(
    'invalid_username' => '잘못된 사용자명입니다. 다시 확인해주세요.',
    'incorrect_password' => '비밀번호가 올바르지 않습니다.',
    'empty_username' => '아이디 또는 이메일을 입력해주세요.',
    'empty_password' => '비밀번호를 입력해주세요.',
    'invalid_email' => '입력하신 이메일 주소를 다시 확인해주세요.',
);

// returned error code from wp-login.php
$err_code = isset($_GET['login']) ? sanitize_text_field($_GET['login']) : '';

if ( $err_code && isset($login_errors[$err_code]) ) :
?>
    <div style="color: red; background: #ffe6e6; padding: 10px; margin-bottom: 20px; border-radius: 4px; text-align: center;">
        <?php echo esc_html( $login_errors[$err_code] ); ?>
    </div>
<?php endif; ?>


    
=======
    <?php if ( isset( $_GET['login'] ) && $_GET['login'] == 'failed' ) : ?>
        <div style="color: red; background: #ffe6e6; padding: 10px; margin-bottom: 20px; border-radius: 4px; text-align: center;">
            로그인 정보가 올바르지 않습니다. 다시 확인해주세요.
            </div>
    <?php endif; ?>
>>>>>>> 5b72f94d7ebfd46f0b6f4a8a32d53866045ffa8e

    <form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
        
        <div class="form-group">
            <input type="text" name="log" class="auth-input" placeholder="이메일 주소 또는 아이디" required>
        </div>
        
        <div class="form-group">
            <input type="password" name="pwd" class="auth-input" placeholder="비밀번호" required>
        </div>

        <div class="login-options">
            <label class="checkbox-label">
                <input name="rememberme" type="checkbox" value="forever"> 기억해 주세요
            </label>
            <span>비밀번호를 잊으셨나요? <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>">여기를 클릭하세요</a></span>
        </div>

        <button type="submit" name="wp-submit" class="btn-auth btn-primary">로그인</button>
        
        <a href="<?php echo home_url('/register'); ?>" class="btn-auth btn-outline">회원 가입하기</a>
        
        <input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>" />

    </form>
</div>

<?php get_footer(); ?>