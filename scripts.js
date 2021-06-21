$(document).ready(function () {
  //dobra funkcija
  $("#ucitajBtn").click(function (e) {
    e.preventDefault();
    $.ajax({
      url:
        "http://localhost:8080/ekonomijacasova/api-fajlovi/ucitaj-student.php",
      type: "GET",
      data: "",
      dataType: "json",

      success: function (studenti) {
        $("#studenti").html("");
        for (let index = 0; index < studenti.length; index++) {
          $("#studenti").append(
            new Option(
              studenti[index].ime_student +
                " " +
                studenti[index].indeks_student,
              studenti[index].id_student
            )
          );
        }
      },
    });
  });

  $("#zaduzivanjeBtn").click(function (e) {
    e.preventDefault();
    let studentId = $("#studenti").val();
    if (studentId) {
      let unetoZaduzivanje = prompt(
        "Unesite zaduzivanje za izabranog studenta (u evrima) :",
        "Kolicina zaduzivanja..."
      );

      if (parseFloat(unetoZaduzivanje)) {
        let opisZaduzivanja = prompt(
          "Unesite opis zaduzivanja:",
          "Opis zaduzivanja..."
        );
        $.ajax({
          type: "POST",
          url:
            "http://localhost:8080/ekonomijacasova/api-fajlovi/dodaj-zaduzivanje.php",
          data: {
            novac_zaduzivanje: unetoZaduzivanje,
            opis_zaduzivanje: opisZaduzivanja,
            id_student: studentId,
          },
          dataType: "json",
          success: function (response) {},
        });
      } else {
        alert("Niste dobro uneli kolicinu novca!");
      }
    } else {
      alert("Prvo izaberite studenta!");
    }
  });

  $("#placanjeBtn").click(function (e) {
    e.preventDefault();
    let studentId = $("#studenti").val();
    if (studentId) {
      let unetoplacanje = prompt(
        "Unesite placanje za izabranog studenta (u evrima) :",
        "Kolicina placanja..."
      );

      if (parseFloat(unetoplacanje)) {
        let opisplacanja = prompt("Unesite opis placanja:", "Opis placanja...");
        $.ajax({
          type: "POST",
          url:
            "http://localhost:8080/ekonomijacasova/api-fajlovi/dodaj-placanje.php",
          data: {
            novac_placanje: unetoplacanje,
            opis_placanje: opisplacanja,
            id_student: studentId,
          },
          dataType: "json",
          success: function (response) {},
        });
      } else {
        alert("Niste dobro uneli kolicinu novca!");
      }
    } else {
      alert("Prvo izaberite studenta!");
    }
  });

  $("#prikaziZaduzivanjeBtn").click(function (e) {
    e.preventDefault();
    $("#zaduzivanjeTable").html("");

    let studentId = $("#studenti").val();
    let studentName = $("#studenti option:selected").text();
    if (studentId) {
      $("#zaduzivanjeCaption").html(studentName);
      $.ajax({
        type: "GET",
        url:
          "http://localhost:8080/ekonomijacasova/api-fajlovi/prikazi-zaduzivanja.php",
        data: {
          id_student: studentId,
        },
        dataType: "json",
        success: function (zaduzivanja) {
          sortZaduzivanje(zaduzivanja);
        },
      });
    }
  });

  $("#prikaziPlacanjeBtn").click(function (e) {
    e.preventDefault();

    $("#placanjeTable").html("");

    let studentName = $("#studenti option:selected").text();

    let studentId = $("#studenti").val();
    if (studentId) {
      $("#placanjeCaption").html(studentName);
      $.ajax({
        type: "GET",
        url:
          "http://localhost:8080/ekonomijacasova/api-fajlovi/prikazi-placanja.php",
        data: {
          id_student: studentId,
        },
        dataType: "json",
        success: function (placanja) {
          sortplacanje(placanja);
        },
      });
    }
  });

  $("#obrisiStudentBtn").click(function (e) {
    e.preventDefault();
    let studentId = $("#studenti").val();
    deleteStudent(studentId);
  });

  function sortZaduzivanje(zaduzivanja) {
    if ($("#sortiranje").val() == "rastuce")
      for (let i = 0; i < zaduzivanja.length - 1; i++) {
        for (let j = 0; j < zaduzivanja.length - i - 1; j++) {
          if (
            parseFloat(zaduzivanja[j].novac_zaduzivanje) >
            parseFloat(zaduzivanja[j + 1].novac_zaduzivanje)
          ) {
            let pom = zaduzivanja[j];
            zaduzivanja[j] = zaduzivanja[j + 1];
            zaduzivanja[j + 1] = pom;
          }
        }
      }
    else if ($("#sortiranje").val() == "opadajuce")
      for (let i = 0; i < zaduzivanja.length - 1; i++) {
        for (let j = 0; j < zaduzivanja.length - i - 1; j++) {
          if (
            parseFloat(zaduzivanja[j].novac_zaduzivanje) <
            parseFloat(zaduzivanja[j + 1].novac_zaduzivanje)
          ) {
            let pom = zaduzivanja[j];
            zaduzivanja[j] = zaduzivanja[j + 1];
            zaduzivanja[j + 1] = pom;
          }
        }
      }
    showZaduzivanje(zaduzivanja);
  }

  function showZaduzivanje(zaduzivanja) {
    for (let index = 0; index < zaduzivanja.length; index++) {
      $("#zaduzivanjeTable").append(`
        <tr>
          <td>${zaduzivanja[index].id_zaduzivanje} </td>
          <td>${zaduzivanja[index].opis_zaduzivanje} </td>
          <td>${zaduzivanja[index].timestamp_zaduzivanje} </td>
          <td>${zaduzivanja[index].novac_zaduzivanje}&#8364 </td>
        </tr>`);
    }
    if (!zaduzivanja.length) {
      $("#zaduzivanjeTable").append(`<tr>
          <td colspan="4"> Ne postoji zaduzivanje za ovog studenta </td>
        </tr>`);
    }
  }

  function sortplacanje(placanja) {
    if ($("#sortiranje").val() == "rastuce")
      for (let i = 0; i < placanja.length - 1; i++) {
        for (let j = 0; j < placanja.length - i - 1; j++) {
          if (
            parseFloat(placanja[j].novac_placanje) >
            parseFloat(placanja[j + 1].novac_placanje)
          ) {
            let pom = placanja[j];
            placanja[j] = placanja[j + 1];
            placanja[j + 1] = pom;
          }
        }
      }
    else if ($("#sortiranje").val() == "opadajuce")
      for (let i = 0; i < placanja.length - 1; i++) {
        for (let j = 0; j < placanja.length - i - 1; j++) {
          if (
            parseFloat(placanja[j].novac_placanje) >
            parseFloat(placanja[j + 1].novac_placanje)
          ) {
            let pom = placanja[j];
            placanja[j] = placanja[j + 1];
            placanja[j + 1] = pom;
          }
        }
      }
    showplacanje(placanja);
  }

  function showplacanje(placanja) {
    for (let index = 0; index < placanja.length; index++) {
      $("#placanjeTable").append(`<tr>
          <td>${placanja[index].id_placanje} </td>
          <td>${placanja[index].opis_placanje} </td>
          <td>${placanja[index].novac_placanje}&#8364 </td>
        </tr>`);
    }
    if (!placanja.length) {
      $("#placanjeTable").append(`<tr>
          <td colspan="3"> Ne postoji placanje za ovog studenta </td>
        </tr>`);
    }
  }

  function deleteStudent(studentID) {
    if (studentID) {
      let sigurni = prompt(
        "Jeste li sigurni da zelite da obrisete studenta? Ako ste sigurni upisite 'DA'."
      );
      if (sigurni === "DA") {
        $.ajax({
          type: "POST",
          url:
            "http://localhost:8080/ekonomijacasova/api-fajlovi/delete-student.php",
          data: {
            id_student: studentID,
          },
          dataType: "json",
          success: function (response) {
            alert(response);
          },
        });
      }
    }
  }
});
