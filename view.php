<?php
function signUpView() {
    function warningName($isReg) {
        if ($isReg) {
            ?>
                <script>
                    if (!$('.warning_name').hasClass('hide')) {
                        $('.warning_name').addClass('hide');
                    }
                </script>
            <?php
        } else {
            ?>
                <script>
                    $('.warning_name').removeClass('hide');
                </script>
            <?php
        }
    }

    function warningLogin($isReg) {
        if ($isReg) {
            ?>
                <script>
                    if (!$('.warning_login').hasClass('hide')) {
                        $('.warning_login').addClass('hide');
                    }
                </script>
            <?php
        } else {
            ?>
                <script>
                    $('.warning_login').removeClass('hide');
                </script>
            <?php
        }
    }

    function warningMail($isReg) {
        if ($isReg) {
            ?>
                <script>
                    if (!$('.warning_mail').hasClass('hide')) {
                        $('.warning_mail').addClass('hide');
                    }
                </script>
            <?php
        } else {
            ?>
                <script>
                    $('.warning_mail').removeClass('hide');
                </script>
            <?php
        }
    }

    function warningPassword($isReg) {
        if ($isReg) {
            ?>
                <script>
                    if (!$('.warning_password').hasClass('hide')) {
                        $('.warning_password').addClass('hide');
                    }
                </script>
            <?php
        } else {
            ?>
                <script>
                    $('.warning_password').removeClass('hide');
                </script>
            <?php
        }
    }

    function warningFile($isReg) {
        if ($isReg) {
            ?>
                <script>
                    if (!$('.warning_file').hasClass('hide')) {
                        $('.warning_file').addClass('hide');
                    }
                </script>
            <?php
        } else {
            ?>
                <script>
                    $('.warning_file').removeClass('hide');
                </script>
            <?php
        }
    }
    function isReg($isReg) {
        if (!$isReg) {
            ?>
                <script>
                    $('.js').html('');
                </script>
            <?php
        }
    }
    ?>
        <!-- <div class="personal">
            <div class="personal_text">Админ</div>
            <div class="personal_arrow">
                <img src="icons/down_arrow.png" alt="">
            </div>
            <div class="list_of_actives hide">
                <div class="active first_active">Добавить книгу</div>
                <div class="active second_active">Обновить книгу</div>
                <div class="active third_active">Удалить книгу</div>
                <div class="active fourth_active">Выйти</div>
            </div>
        </div> -->
        <?php
    }

function signInAdminView() {
?>
    <div class="personal">
        <div class="personal_text">Админ</div>
        <div class="personal_arrow">
            <img src="icons/down_arrow.png" alt="">
        </div>
        <div class="list_of_actives hide">
            <div class="active first_active">Добавить книгу</div>
            <div class="active second_active">Обновить книгу</div>
            <div class="active third_active">Удалить книгу</div>
            <div class="active fourth_active">Выйти</div>
        </div>
    </div>
    <?php
}

?>