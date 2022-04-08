/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
/**
 * 
 * MODAL
 * 
 */
// Open modal
function openModalInit() {
  var btnActiveModal = document.querySelectorAll('.btn_open_modal');
  eventModal(btnActiveModal);
} // Close modal


function closeModalInit() {
  var btnCloseModal = document.querySelectorAll('.btn_close_modal');
  eventModal(btnCloseModal);
} // Initialisation of btn


closeModalInit(); // Function to show and hide modal

function eventModal(elementActionModal) {
  elementActionModal.forEach(function (element) {
    element.addEventListener('click', function () {
      var elementId = element.getAttribute('data-modal-id');
      document.querySelector('#' + elementId).classList.toggle("active_modal_container");
      document.body.classList.toggle("hidden");
    });
  });
}

$(function () {
  // SEARCH
  getPraticienName(); // SEARCH NAME / CITY OF PRATICIEN

  $("#praticien-name").keyup(function () {
    getPraticienName($('#praticien-name').val());
  }); // SEARCH TYPE OF PRATICIEN

  $(".item_filter").each(function () {
    $(this).click(function () {
      $("#praticien-name").val($(this).text());
      getPraticienName($(this).text());
      showFilter();
    });
  }); // FUNCTION TO SHOW LIST OF TYPE PRATICIEN

  function showFilter() {
    $(".search_filter").toggleClass("show_search_filter");
    $(".search_btn_filter > .bx").toggleClass("bx-filter-alt");
    $(".search_btn_filter > .bx").toggleClass("bx-x");
  }

  $(".search_btn_filter").click(function () {
    showFilter();
  }); // FUNCTION TO SEARCH PRATICIEN

  function getPraticienName(data) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "POST",
      url: 'praticiens',
      data: {
        praticien_name: data //praticien_type: $('#praticien-name').val()

      },
      success: function success(data) {
        $('.search_result').html(data);
        showProfilPraticien(); // Initialisation of btn

        openModalInit();
      },
      error: function error(data) {
        console.log(data); // Initialisation of btn

        openModalInit();
      }
    });
  } // FUNCTION TO SHOW PROFIL OF PRATICIEN


  function showProfilPraticien() {
    $(".search_result_praticien").each(function () {
      $(this).click(function () {
        $(".modal_profil_praticien").addClass("active_modal");
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "POST",
          url: 'praticiens',
          data: {
            praticien_id: $(this).attr("data-id")
          },
          success: function success(data) {
            $('.profil_praticien_container').html(data);
          },
          error: function error(data) {
            console.log(data);
          }
        });
      });
    });
  } // CLOSE MODAL PROFIL PRATICIEN


  $(".btn_close_modal").click(function () {
    $(".modal_profil_praticien").removeClass("active_modal");
  });
  /**
   * 
   *  Rapport de visite
   * 
   */
  // ADD MED ITEM IN MED LIST

  var btnNewMed = $(".btn_new_med");
  var nameOfMed = $("#med-option-name");
  var quantityOfMed = $("#med-quantity");
  quantityOfMed.val(0);
  var medList = $(".med_list");
  btnNewMed.click(function () {
    if (nameOfMed.val() != "defaultValue" && quantityOfMed.val() > 0) {
      var medItem = $(".med_item"); // ADD IN HTML MED-NAME AND MED-QUANTITY

      if (medItem) {
        var medIsAlreadyAddInList = false;
        medItem.each(function () {
          if ($(this).children('td:nth-child(1)').children().val() == nameOfMed.children(":selected").text()) {
            medIsAlreadyAddInList = true;
          }
        });

        if (medIsAlreadyAddInList == false) {
          medList.append('<tr class="med_item"><td class="med_name"><input type="text" name="med_depotlegal_' + (medItem.length + 1) + '" value="' + nameOfMed.children(":selected").text() + '"></td><td class="med_quantity"><input type="number" name="med_quantity_' + (medItem.length + 1) + '" value="' + quantityOfMed.val() + '" min="0"></td><td class="btn_delete_med_item"><i class="bx bx-trash"></i></td></tr>');
        } else {
          console.log('Le médicament est déjà ajouté dans la liste');
        }
      } else {
        medList.append('<tr class="med_item"><td class="med_name"><input type="text" name="med_depotlegal_' + (medItem.length + 1) + '" value="' + nameOfMed.children(":selected").text() + '"></td><td class="med_quantity"><input type="number" name="med_quantity_' + (medItem.length + 1) + '" value="' + quantityOfMed.val() + '" min="0"></td><td class="btn_delete_med_item"><i class="bx bx-trash"></i></td></tr>');
      }
    } // RESET CHOICE OF MED-NAME AND MED-QUANTITY


    nameOfMed.val("defaultValue");
    quantityOfMed.val(0); // REFRESH 

    removeMedItem();
  }); // DELETE MED ITEM IN MED LIST

  function removeMedItem() {
    var btnDeleteMedItem = $(".btn_delete_med_item");
    btnDeleteMedItem.each(function () {
      $(this).click(function () {
        $(this).parent(".med_item").remove();
      });
    });
  }
});
/******/ })()
;