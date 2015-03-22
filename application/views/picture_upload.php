<div class="form">
    <form enctype="multipart/form-data" action="/admin/upload_picture/0" method="POST">
        <b>Choose a mugshot to upload:</b><br />
        <input name="userfile" type="file" /><br /> <!--name must be "userfile" or things break-->
        <input type="submit" value="Upload File" /><br />
        {errors}
    </form>
</div>