<!Doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css" />

    <title>Home Page</title>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg py-3 sticky-top navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img class="logo" src="img/publications-logo.webp">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="RefSearching.html">References Searching</a>
                    </li>
                </ul>
                <button onclick="document.location='signIn.php'" class="btn btn-primary ms-lg-3">Sign
                    In</button>
                <button onclick="document.location='signUp.php'" class="btn btn-primary ms-lg-3">Sign
                    Up</button>
            </div>
        </div>
    </nav>

    <div class="container">

        <p></p>

        <h5>Publications</h5>

        <p></p>
        <!-- SEARCHING ENGINE -->
        <div class="col-md-12">
            <div class="container border">
                <p></p>

                <div class="table-responsive">

                    <table class="table table-striped table-sm">
                        <tr>
                            <td style="width: 80px">
                                Duration:
                            </td>
                            <td>
                                <select name="SrchMStart" class="">

                                    <option value="1" selected>1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </td>
                            <td>
                                <select name="SrchYStart" class="">
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021" selected>2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                </select>
                            </td>
                            <td style="text-align: center">
                                to
                            </td>
                            <td>
                                <select name="SrchMEnd" class="">

                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8" selected>8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </td>
                            <td>
                                <select name="SrchYEnd" class="">
                                    <option value="2023">2023</option>
                                    <option value="2022" selected>2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                </select>
                            </td>

                            <td style="width: 20px">
                                <!-- giãn cách -->
                            </td>

                            <td>
                                Field:
                            </td>
                            <td>
                                <select class="" name="SrchField">

                                    <option value="All" selected>All fields</option>
                                    <option value="KHTN">Natural sciences and engineering</option>
                                    <option value="KHXH">Social sciences and humanities</option>
                                </select>
                            </td>

                            <td>
                                <!-- để dành cho nút search -->
                            </td>
                        </tr>



                        <tr>
                            <td>
                                Divisions:
                            </td>
                            <td colspan="5">
                                <select name="SrchDevisions" class="">
                                    <!-- phong/ban/khoa/trung tam , bo mon -->
                                    <option value="all,all" selected>All divisions</option>


                                    <option value="Architecture,null">Architecture</option>
                                    <option value="Business & Economy,null">Business & Economy</option>
                                    <option value="Education">Education</option>
                                    <option value="Health & Medical Sciences,null">Health & Medical Sciences</option>
                                    <option value="History">History</option>
                                    <option value="Humanities & Art">Humanities & Art</option>
                                    <option value="Law">Law</option>
                                    <option value="Philosophy">Philosophy</option>
                                    <option value="Social Sciences">Social Sciences</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Technology & Engineering">Technology & Engineering</option>
                                    <option value="Tourism">Tourism</option>
                                </select>
                            </td>

                            <td style="width: 20px">
                                <!-- giãn cách -->
                            </td>

                            <td>
                                Keywords:
                            </td>
                            <td>
                                <input type="text" class="" name="SrchKey" value="" placeholder="Title, ID..."
                                    autocomplete="off">
                            </td>


                            <td>
                                <input type="text" class="" name="SrchKeyJ" value="" placeholder="Journal name"
                                    autocomplete="off">
                            </td>

                        </tr>


                        <tr>
                            <td>
                                Type:
                            </td>
                            <td colspan="5">
                                <select name="SrchType" class="">
                                    <!-- cate - type - class -->
                                    <option value="all,all,all" selected>All types</option>


                                    <option value="Journal article,SCI-E,International">SCI-E journal papers
                                    </option>


                                    <option value="Journal article,SSCI,International">SSCI journal papers</option>


                                    <option value="Journal article,non-ISI,International">non-ISI journal papers
                                    </option>


                                    <option value="Journal article,AHCI,International">AHCI journal papers</option>


                                    <option value="Journal article,ESCI,International">ESCI journal papers</option>



                                    <option value="Journal article,null,Domestic">Domestic journal papers</option>


                                    <option value="Conference paper in a proceeding,null,International">
                                        International conference papers</option>


                                    <option value="Conference paper in a proceeding,null,Domestic">Domestic
                                        conference papers</option>



                                    <option value="Book,null,null">Books</option>




                                    <option value="Journal article,None,International">None</option>
                                </select>
                            </td>

                            <td style="width: 20px">
                                <!-- giãn cách -->
                            </td>

                            <td>Authors:</td>

                            <td>
                                <input type="text" class="" name="SrchAuthor" value="" placeholder="Author's name"
                                    autocomplete="off">
                            </td>

                            <td><button class="btn btn-primary" name="BtnSrch"><i class="fas fa-search"></i>
                                    Search</button></td>

                        </tr>

                    </table>

                </div>
                <p></p>
            </div>
        </div>
        <p></p>
        <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>