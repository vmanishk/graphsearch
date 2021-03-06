<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Welcome </span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="bootstrap-elements.html">Welcome</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="./logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li class="active">
                            <a href="./users.php"><i class="fa fa-fw fa-user"></i>Home</a>
                        </li>
                        <li>
                            <a href="./graph.php"><i class="fa fa-fw fa-wrench"></i> Graph Search</a>
                        </li>
                    </nav>

                    <div id="page-wrapper">

                        <div class="container-fluid">

                            <!-- Page Heading -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">
                                        WELCOME <?php session_start();  echo $_SESSION["name"]; ?>
                                    </h1>
                                </div>
                            </div>

                            <div class="page-header">
                                <h1>Personal Information</h1>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <ul class="list-group">
                                       <li class="list-group-item">Full Name</li>
                                       <li class="list-group-item">Username</li>
                                       <li class="list-group-item">Email Id</li>

                                   </ul>
                               </div>
                               <!-- /.col-sm-4 -->
                               <div class="col-sm-4">
                                <div class="list-group">
                                    <a href="#" class="list-group-item"><?php   echo $_SESSION["name"]; ?></a>
                                    <a href="#" class="list-group-item "><?php  echo $_SESSION["user"]; ?></a>
                                    <a href="#" class="list-group-item"><?php  echo $_SESSION["email"]; ?></a>

                                </div>
                            </div>


                        </div>

                        <div class="page-header">
                            <h1>Interests</h1>
                        </div>

                        <?php

                        require 'vendor/autoload.php';
                        $neo4j = new EndyJasmi\Neo4j;  

                        $user = $_SESSION['user']; 


                        $query = 'match (:Person {username:'."\"$user\"".'})-[:LIKES]-(n) return collect(n.name) as m';
                        try{
                            $result = $neo4j->statement($query);
                        }
                        catch (EndyJasmi\Neo4j\Error\Neo\ClientError\Statement\InvalidSyntax $e) {

                            echo $e;
                        }

                        catch (EndyJasmi\Neo4j\Error\Neo\ClientError\Statement $e) {

                            echo $e;
                        }

                        catch (EndyJasmi\Neo4j\Error\Neo\ClientError $e) {

                            echo $e;
                        }
                        catch (EndyJasmi\Neo4j\Error\Neo $e) {
                            echo "no";
                        }

                        if(!is_null($result)){
                            $arr = $result[0]['m'];



                            ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <ul class="list-group">

                                        <?php

                                        $i = 1;
                                        foreach ($arr as  $value) {

                                            echo '<li class="list-group-item">Field '.$i.'</li>';
                                            $i = $i +1;
                                        }

                                        ?>
                                    </ul>
                                </div>
                                <!-- /.col-sm-4 -->
                                <div class="col-sm-4">
                                    <div class="list-group">

                                        <?php
                                        foreach ($arr as  $value) {

                                            echo '<li class="list-group-item">'.$value.'</li>';
                                            $i = $i +1;
                                        }

                                        ?>

                                    </div>
                                </div>


                            </div>

                            <?php
                        }
                        ?>
                        <!-- /#page-wrapper -->


                    </div>
                    <!-- /#wrapper -->

                    <!-- jQuery -->
                    <script src="js/jquery.js"></script>

                    <!-- Bootstrap Core JavaScript -->
                    <script src="js/bootstrap.min.js"></script>

                </body>

                </html>
