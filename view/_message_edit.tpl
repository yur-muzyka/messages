<div id="m_{id}">
<tr>
    <form action="controller/message.php" method=post>
        <tr>
            <td><textarea id="text" name="address" cols="20" rows="3">{text}</textarea>
                <input id="m_id" type="hidden" name="id" value="{id}"/>
            </td>
        </tr>
        <tr>    
            <td align="right"><input class="btnSubmit" type="submit" value="Cancel"><input class="btnSubmit" type="submit" value="Save"></td>
        </tr>
    </form>
</tr>
</div>