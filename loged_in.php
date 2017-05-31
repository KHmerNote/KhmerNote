<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Taking Note</title>
    <script src="vendors/js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="public/css/styleLogedin.css">
</head>
<body class="login">
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
            </button>
            <a class="navbar-brand" href="loged_in.php">Taking Note</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-right" method="post">
<!--                <a class="btn btn-primary" href="./pages/Logout.php">Logout</a>&nbsp;&nbsp;-->
                <?php
                require_once ('./vendors/config/dbconfig.php');
                $username = $_SESSION['username'];
                $sql = "select * from users where username='$username'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_object()){
                    echo "<a href='pages/userProfile.php'><img src=./pages/$row->photo style='width: 40px; height: 40px; border-radius: 100px;'></a>";
                    echo "<span>&nbsp;&nbsp;$row->username</span>";
                }
                ?>
            </form>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="col-sm-12 col-md-10 col-md-offset-1 container">
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><p class="glyphicon glyphicon-search" style="font-size: large;"></p></span>
            <input type="text" name="search_text" id="search_text" placeholder="Search by Title Details" class="form-control input-lg" />
            <a class="input-group-addon" data-toggle="modal" data-target="#note" data-whatever="@mdo" id="new_note"><p class="glyphicon glyphicon-plus" style="font-size: large"></p></a>
        </div>
    </div>
    <br />
    <div id="result"></div>
</div>
<!--take a note button modal-->
<div class="col-sm-12 modal fade" id="note" tabindex="-1" role="dialog" aria-labelledby="noteLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="noteLabel">Take a note</h4>
            </div>
            <div class="modal-body">
                <form autocomplete="off">
                    <div class="form-group">
                        <label for="title" class="control-label">Title</label>
                        <?php
                            if (isset($_POST['btn_edit'])){
                                require_once ('vendors/config/dbNoteconfig.php');
                                $id = $_POST['edit'];
                                $sql = "select * from note where id='$id'";
                                $result = $conn->query($sql);
                                $row = $result->fetch_object();
                                echo "<input type=\"text\" class=\"form-control\" name=\"title\" id=\"title\" value='$row->title'>";
                                echo "</div>
                                        <div class=\"form-group\">
                                            <label for=\"content\" class=\"control-label\">Content</label>";
                                echo "<textarea class=\"form-control\" name=\"content\" id=\"content\">$row->content</textarea>";
                            }else{
                                echo "<input type=\"text\" class=\"form-control\" name=\"title\" id=\"title\">";
                                echo "</div>
                                        <div class=\"form-group\">
                                            <label for=\"content\" class=\"control-label\">Content</label>";
                                echo "<textarea class=\"form-control\" name=\"content\" id=\"content\"></textarea>";
                            }
                        ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="btn_add" id="btn_add">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    $(document).ready(function(){

        load_data();

        function load_data(query)
        {
            $.ajax({
                url:"pages/fetch.php",
                method:"POST",
                data:{query:query},
                success:function(data)
                {
                    $('#result').html(data);
                }
            });
        }
        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != '')
            {
                load_data(search);
            }
            else
            {
                load_data();
            }
        });
    });
    $(document).ready(function(){
        function fetch_data()
        {
            $.ajax({
                url:"pages/fetch.php",
                method:"POST",
                success:function(data){
                    $('#result').html(data);
                }
            });
        }
        fetch_data();
        $(document).on('click', '#btn_add', function(){
            var title = document.getElementById("title").value;
            var content = document.getElementById("content").value;
            var username = "<?php echo $_SESSION['username'] ?>";

            if(!title.length){
                alert("Enter Title");
                return false;
            }
            if(!content.length){
                alert("Enter Content");
                return false;
            }
            $.ajax({
                url:"pages/insert.php",
                method:"POST",
                data:{title:title, content:content, username:username},
                dataType:"text",
                success:function(data)
                {
                    //alert(data);
                    fetch_data();
                }
            })
        });
        function edit_data(id, text, content)
        {
            $.ajax({
                url:"pages/edit.php",
                method:"POST",
                data:{id:id, text:text, column_name:column_name},
                dataType:"text",
                success:function(data){
                    //alert(data);
                }
            });
        }
        $(document).on('blur', '.title', function(){
            var id = $(this).data("id1");
            var title = $(this).text();
            edit_data(id, title, "title");
        });
        $(document).on('blur', '.content', function(){
            var id = $(this).data("id2");
            var content = $(this).text();
            edit_data(id,content, "content");
        });
        $(document).on('click', '.btn_delete', function(){
            var id=$(this).data("id3");
            if(confirm("Are you sure you want to delete this?"))
            {
                $.ajax({
                    url:"pages/delete.php",
                    method:"POST",
                    data:{id:id},
                    dataType:"text",
                    success:function(data){
                        //alert(data);
                        fetch_data();
                    }
                });
            }
        });
    });

</script>