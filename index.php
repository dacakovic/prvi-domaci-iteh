<html>

<head>

    <?php include('zaglavlje.php') ?>
</head>

<body>



    <div id="main-div">
        <div id="tabele" class="row">
            <div class="col-2">

                <br>

                <select name="studenti" id="studenti">
                    <option value="" disabled selected hidden>Izaberite studenta...</option>
                </select>

                <br>
                <button id="ucitajBtn">Ucitaj studente</button>
                <br>
                <button id="zaduzivanjeBtn">Zaduzivanje</button>
                <br>
                <button id="placanjeBtn">Placanje</button>
                <br>
                <button id="prikaziZaduzivanjeBtn">Prikazi zaduzivanja</button>
                <br>
                <button id="prikaziPlacanjeBtn">Prikazi placanje</button>
                <br>
                <select name="sortiranje" id="sortiranje">
                    <option value="" disabled selected hidden>Izaberite sortiranje...</option>
                    <option value="rastuce">Rastuce</option>
                    <option value="opadajuce">Opadajuce</option>
                    <option value="bez">Bez sortiranja</option>
                </select>
                <button id="obrisiStudentBtn" class="btn btn-danger">Obrisi studenta</button>
                <br>
            </div>
            <div class="col">
                <br>
                <p id="zaduzivanjeCaption"></p>


                <table border="4px" class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Id zaduzivanja</th>
                            <th scope="col">Opis</th>
                            <th scope="col">Datum zaduzivanja</th>
                            <th scope="col">Kolicina zaduzivanja</th>
                        </tr>
                    </thead>
                    <tbody id="zaduzivanjeTable">

                    </tbody>
                </table>
            </div>

            <div class="col">
                <br>
                <p id="placanjeCaption"></p>

                <table border="4px" class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Id placanja</th>
                            <th scope="col">Opis</th>
                            <th scope="col">Kolicina placanja</th>
                        </tr>
                    </thead>
                    <tbody id="placanjeTable">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="./scripts.js"></script>
</body>

</html>