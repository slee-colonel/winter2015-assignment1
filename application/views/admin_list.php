<div class="row container-fluid" style="width: 100%">
    <h2>People</h2>
    <table cols="3" class="table" >
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Mugshot</th>
            <th></th>
            <th></th>
        </tr>
        {people}
        <tr>
            <td>{id}</td>
            <td>{who}</td>
            <td>{mug}</td>
            <td><a href='/admin/edit_person/{id}' class="btn">Edit</a></td>
            <td><a href='/admin/delete_person/{id}' class="btn">Delete</a></td>
        </tr>
        {/people}
    </table>
    <a href='/admin/add_person'>Add a new rich person</a><br/>
    <a class="right" href='/admin/upload_picture/1'>Upload a mugshot</a>
</div>

<div class="row container-fluid" style="width: 100%">
    <h2>Articles</h2>
    <table cols="3" class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Title</th>
            <th>Text</th>
            <th>Owed</th>
            <th></th>
            <th></th>
        </tr>
        {articles}
        <tr>
            <td>{id}</td>
            <td>{who}</td>
            <td>{title}</td>
            <td>{text}</td>
            <td>{owed}</td>
            <td><a href='/admin/edit_article/{id}' class="btn">Edit</a></td>
            <td><a href='/admin/delete_article/{id}' class="btn">Delete</a></td>
        </tr>
        {/articles}
    </table>
    <a href='/admin/add_article'>Add a new article</a>
</div>