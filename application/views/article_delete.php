<!-- Page to confirm deletion of an article from database. -->
<div class="row container-fluid">
    <h2>Are you sure you want to delete this article?</h2>
    <form action="/admin/confirm_article_deletion" method="post">
        {fid}
        {fwho}
        {ftitle}
        {fowed}
        {ftext}
        {fsubmit}
    </form>
</div>
