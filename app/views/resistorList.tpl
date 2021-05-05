{extends file="main.tpl"}

{block name=content}

<table id="tab_values" class="pure-table pure-table-bordered">
<thead>
	<tr>
		<th>U zasilania (V)</th>
		<th>U diody (V)</th>
		<th>I diody (mA)</th>
		<th>Rezystor</th>
                <th>Opcje</th>
	</tr>
</thead>
<tbody>
{foreach $resistors as $r}
{strip}
	<tr>
		<td>{$p["v1"]}</td>
		<td>{$p["v2"]}</td>
		<td>{$p["amp"]}</td>
                <td>{$p["resistor"]}</td>
		<td>
			<a class="button-small pure-button button-warning" href="{$conf->action_url}resistorDelete&id={$r['id']}">Usuń</a>
		</td>
	</tr>
{/strip}
{/foreach}
</tbody>
</table>

{/block}