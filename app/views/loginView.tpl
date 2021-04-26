{extends file="main.tpl"}

{block name=content}

        <div class="box">
	<div class="content">
            <h2 class="align-center">Logowanie</h2>
            <hr />
            <div class="l-box-lrg pure-u-1 pure-u-med-2-5" style="width:30%;margin: 2em auto;">
		<form class="pure-form pure-form-stacked" action="{$conf->action_url}login" method="post">
                    <fieldset>
		<div class="field half first">
                    <label for="id_login">Login:</label>
                    <input name="login" id="id_login" type="text" placeholder="login" value="{$form->login}">
		</div>
		<div class="field half">
                    <label for="id_pass">Hasło:</label>
                    <input name="pass" id="id_pass" type="password" placeholder="hasło" value="{$form->pass}">
		</div>
		<ul class="actions align-center">
                    <li><input value="Zaloguj" class="button special" type="submit"></li>
		</ul>
                    </fieldset>
		</form>
	</div>
    </div>
    </div>

{include file='messages.tpl'}

{/block}