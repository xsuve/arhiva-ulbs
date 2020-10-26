$(function() {

  var URL = 'http://localhost/arhiva-ulbs/';

  $(document).ready(function() {

    // Navbar
    $('.navbar-c-mobile-button span').on('click', function() {
      $('.navbar-c-mobile-links').slideToggle();
    });

    // Get Specializare Materii
    var specializare_id = 0;
    var anul = 0;
    var semestrul = 0;
    $('#postSpecializare').on('change', function() {
      specializare_id = $(this).val();
      searchMaterii();
    });
    $('#postAnul').on('change', function() {
      anul = $(this).val();
      searchMaterii();
    });
    $('#postSemestrul').on('change', function() {
      semestrul = $(this).val();
      searchMaterii();
    });

    var searchMaterii = () => {
      if(specializare_id != 0 && anul != 0 && semestrul != 0) {
        $('#postMaterie').html('<option disabled selected>Materie</option>');
        $.ajax({
          url: URL + 'subiect/getmaterii/' + specializare_id + '/' + anul + '/' + semestrul,
          type: 'POST',
          success: function(json) {
            var materii = JSON.parse(json);
            for(var i = 0; i < materii.length; i++) {
              $('#postMaterie').append('<option value="' + materii[i].id + '">' + materii[i].title + '</option>');
            }
          }
        });
      }
    }

    // Copy Invitation
    $('#copyInvitationBtn').on('click', function() {
      var input = document.getElementById('invitationInput');
      var invitationCode = input.value;
      input.select();
      document.execCommand('copy');
      input.value = 'Cod copiat!'
      setTimeout(function() {
        input.value = invitationCode;
      }, 1000);
    });

    // Post Image
    $('#postSubiectInput').on('change', function() {
      if(this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#postSubiectInputPreview').attr('src', e.target.result);
          $('#postSubiectInputSpan').hide();
        }
        reader.readAsDataURL(this.files[0]);
      }
    });

    // Thanks Button
    $(document).on('click', '.thanks-btn', function() {
      var subiect_id = $(this).data('subiect-id');
      var subiect_thanks = parseInt($(this).data('subiect-thanks'));
      $.ajax({
        url: URL + 'subiect/thank',
        type: 'POST',
        data: 'subiect_id=' + subiect_id,
        success: function(json) {
          var res = JSON.parse(json);
          if(res) {
            subiect_thanks += 1;
            $('.thanks-btn[data-subiect-id="' + subiect_id + '"]').addClass('subiect-thanked');
            $('.thanks-btn[data-subiect-id="' + subiect_id + '"]').attr('data-subiect-thanks', subiect_thanks);
            if(subiect_thanks > 0) {
              if(subiect_thanks > 1) {
                $('.subiect-thanks[data-subiect-id="' + subiect_id + '"]').html('<span>' + subiect_thanks + '</span> mulțumiri');
              } else {
                $('.subiect-thanks[data-subiect-id="' + subiect_id + '"]').html('<span>' + subiect_thanks + '</span> mulțumire');
              }
            } else {
              $('.subiect-thanks[data-subiect-id="' + subiect_id + '"]').html('<span>' + subiect_thanks + '</span> mulțumiri');
            }
          }
        }
      });
    });

  });

});
