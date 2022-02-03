<?php
    ob_start();
?>
    <style>
        form {
            border: 1px solid black;
        }
    </style>
    <form action="/ui.php" method="POST">
        <h1>HMAC Hash Input</h1>
        <fieldset>
            <legend>Input text to hash</legend>
            <input name="input" id="input" type="text" />
        </fieldset>

        <fieldset>
            <legend>HMAC secret ("NULL" for NULL)</legend>
            <input name="secret" id="secret" type="text" />
        </fieldset>
        <fieldset>
            <input type="submit" value="Submit" />
        </fieldset>
    </form>
    <form action="/" method="POST">
        <h1>Vulnerability Test 1</h1>
        <fieldset>
            <legend>Host to check</legend>
            <input name="host" id="host" type="text" />
        </fieldset>
        <fieldset>
            <legend>Verification HMAC</legend>
            <input name="hmac" id="hmac" type="text" />
        </fieldset>
        <fieldset>
            <input type="submit" value="Submit" />
        </fieldset>
    </form>
<?php
    $form_html = ob_get_clean();
    ob_start();
?>
    <form action="/" method="POST">
        <h1>Vulnerability Test 2</h1>
        <fieldset>
            <legend>Host to check</legend>
            <input name="host" id="host" type="text" />
        </fieldset>
        <fieldset>
            <legend>Verification HMAC</legend>
            <input name="hmac" id="hmac" type="text" />
        </fieldset>
        <fieldset>
            <legend>Nonces</legend>
            <input name="nonce[]" value="1" type="text" disabled />
            <input name="nonce[]" value="2" type="text" disabled />
        </fieldset>
        <fieldset>
            <input type="submit" value="Submit" />
        </fieldset>
    </form>
<?php
    $extra_form_html = ob_get_clean();

    if (getenv("USE_SECOND_STAGE") !== false) {
        $form_html .= $extra_form_html;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo $form_html;
    } else {
        if ($_POST['secret'] === 'NULL') {
?>
    <div>
        <h1>HMAC Results</h1>
        <pre><?php echo hash_hmac('sha256', $_POST['input'], NULL); ?></pre>
    </div>
<?php
        } else {
?>
    <div>
        <h1>HMAC Results</h1>
        <pre><?php echo hash_hmac('sha256', $_POST['input'], $_POST['secret']); ?></pre>
    </div>
<?php
        }
        echo $form_html;
    }
