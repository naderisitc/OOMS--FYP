<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['tlogin']) == 0) {
    header('location:tindex.php');
} else {
    if ($_POST['submit'] == "Update") {
        $pagetype = $_GET['type'];
        $pagedetails = $_POST['pgedetails'];
        $sql = "UPDATE tablepage SET detail=:pagedetails WHERE type=:pagetype";
        $query = $dbh->prepare($sql);
        $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
        $query->bindParam(':pagedetails', $pagedetails, PDO::PARAM_STR);
        $query->execute();
        $msg = " Page info updated  successfully";
    }
    ?>

    <!doctype html>
    <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Admin |  Manage Pages</title>

            <link rel="stylesheet" href="css/font-awesome.min.css"> <!-- Bootstrap Icons -->
            <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Main Bootstrap -->
            <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">   <!-- Bootstrap Data tables --> 
            <link rel="stylesheet" href="css/style.css"> <!-- Header Stye -->

            <script type="text/JavaScript">
                <!--
                function MM_findObj(n, d) { //v4.01
                var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
                d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
                if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
                for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
                if(!x && d.getElementById) x=d.getElementById(n); return x;
                }

                function MM_validateForm() { //v4.0
                var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
                for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
                if (val) { nm=val.name; if ((val=val.value)!="") {
                if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
                if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
                } else if (test!='R') { num = parseFloat(val);
                if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
                if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
                min=test.substring(8,p); max=test.substring(p+1);
                if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
                } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
                } if (errors) alert('The following error(s) occurred:\n'+errors);
                document.MM_returnValue = (errors == '');
                }

                function MM_jumpMenu(targ,selObj,restore){ //v3.0
                eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
                if (restore) selObj.selectedIndex=0;
                }
                //-->
            </script>
            <script type="text/javascript" src="js/nicEdit.js"></script>
            <script type="text/javascript">
                bkLib.onDomLoaded(function () {
                    nicEditors.allTextAreas()
                });
            </script>
            <style>
                .errorWrap {
                    padding: 10px;
                    margin: 0 0 20px 0;
                    background: #fff;
                    border-left: 4px solid #dd3d36;
                    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                }
                .succWrap{
                    padding: 10px;
                    margin: 0 0 20px 0;
                    background: #fff;
                    border-left: 4px solid #5cb85c;
                    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                }
            </style>


        </head>

        <body>
            <?php include('includes/header.php'); ?>
            <div class="ts-main-content">
                <?php include('includes/leftbar.php'); ?>
                <div class="content-wrapper">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">

                                <h2 class="page-title"><font face="Comic Sans MS" color="red">Manage Pages</font></h2>

                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="color: green;">Form fields</div>
                                            <div class="panel-body">
                                                <form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">

                                                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) {
                                                        ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">Select Page</label>
                                                        <div class="col-sm-8">
                                                            <select name="menu1" onChange="MM_jumpMenu('parent', this, 0)">
                                                                <option value="" selected="selected" class="form-control">***Select One***</option>

                                                                <option value="manage-pages.php?type=about">About Us</option> 
                                                                <option value="manage-pages.php?type=donor">Why Be A Donor</option>
                                                                <option value="manage-pages.php?type=matching-organs">How Matching Works?</option> 
                                                                <option value="manage-pages.php?type=living-donation">Living Donation</option>
                                                                <option value="manage-pages.php?type=deceased-donation">Deceased Donation</option> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="hr-dashed"></div>

                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">Selected Page</label>
                                                        <div class="col-sm-8"></div>
                                                        <?php
                                                        switch ($_GET['type']) {
                                                            case "about" :
                                                                echo " About Us";
                                                                break;

                                                            case "donor" :
                                                                echo "Why Be a Donor?";
                                                                break;

                                                            case "matching-organs" :
                                                                echo "How Matching Works?";
                                                                break;

                                                            case "living-donation" :
                                                                echo "Living Donation";
                                                                break;
                                                            case "deceased-donation" :
                                                                echo "Deceased Donation";
                                                                break;

                                                            default :
                                                                echo "";
                                                                break;
                                                        }
                                                        ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">Page Details </label>
                                                        <div class="col-sm-8">
                                                            <textarea class="form-control" rows="5" cols="50" name="pgedetails" id="pgedetails" placeholder="Package Details" required>
    <?php
    $pagetype = $_GET['type'];
    $sql = "SELECT detail from tablepage where type=:pagetype";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            echo htmlentities($result->detail);
        }
    }
    ?>
                                                            </textarea> 
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-8 col-sm-offset-4">

                                                            <button type="submit" name="submit" value="Update" id="submit" class="btn btn-primary btn-lg"><font face="Trebuchet MS" style="font-size:14px;"><b>Update</b>&nbsp;<span class="glyphicon glyphicon-ok"></span></font></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading Scripts -->
            <script src="js/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.dataTables.min.js"></script>
            <script src="js/dataTables.bootstrap.min.js"></script>
            <script src="js/main.js"></script>

        </body>
    </html>
    <?php }
