<?= $this->extend('user/layouts/main') ?>


<?= $this->section('content') ?>
<style>
  .tree, .tree ul {
    margin:0;
    padding:0;
    list-style:none
}
.tree ul {
    margin-left:1em;
    position:relative
}
.tree ul ul {
    margin-left:.5em
}
.tree ul:before {
    content:"";
    display:block;
    width:0;
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    border-left:1px solid
}
.tree li {
    margin:0;
    padding:0 1em;
    line-height:2em;
    color:#369;
    font-weight:700;
    position:relative
}
.tree ul li:before {
    content:"";
    display:block;
    width:10px;
    height:0;
    border-top:1px solid;
    margin-top:-1px;
    position:absolute;
    top:1em;
    left:0
}
.tree ul li:last-child:before {
    background:#fff;
    height:auto;
    top:1em;
    bottom:0
}
.indicator {
    margin-right:5px;
}
.tree li a {
    text-decoration: none;
    color:#369;
}
.tree li button, .tree li button:active, .tree li button:focus {
    text-decoration: none;
    color:#369;
    border:none;
    background:transparent;
    margin:0px 0px 0px 0px;
    padding:0px 0px 0px 0px;
    outline: 0;
}
</style>
<div class="dashboard_main">
  <div class="row m-0">

    <div class="col-12">
    

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?=base_url(route_to('dashboard'))?>">Dashboard</a></li>
    <!-- <li class="breadcrumb-item"><a href="#">Library</a></li> -->
    <li class="breadcrumb-item active" aria-current="page">Down Tree</li>
  </ol>
</nav>
<div class="row">
  <div class="col-md-12">
    <h3>Down Tree</h3>
  </div>

  <div class="col-md-12">
    <?php function printTree($list){
      echo  "<ul>";
        foreach($list as $item){
         
          if(isset($item['children'])){
            echo "<li><a href='#'>".$item['id']." (".$item['first_name']." ".$item['last_name'].") [".(count($item['children']))."]</a>";
            printTree($item['children']);
            echo "</li>";
          }else{
            echo "<li>".$item['id']." (".$item['first_name'].")</li>";
          }
        }
        echo "</ul>";
    }
   
    ?>
<ul id="tree1">
                
                <li><a href="#"><?=$user['id']." (".$user['first_name']." ".$user['last_name'].")"?> [<?=count($tree)?>]</a>

                <?php  printTree($tree);?>
                </li>
                
</ul>
    


  </div>
</div>





    </div>
  </div>
</div>
<script>
  $.fn.extend({
    treed: function (o) {
      
      var openedClass = 'fa-minus';
      var closedClass = 'fa-plus';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator fa " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
      tree.find('.branch .indicator').each(function(){
        $(this).on('click', function () {
            $(this).closest('li').click();
        });
      });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});

//Initialization of treeviews

$('#tree1').treed();

</script>

<?= $this->endSection() ?>