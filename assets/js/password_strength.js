$(document).ready(function ($) {
  $("#password_input").strength_meter({
    strengthMeterClass: "t_strength_meter",
  });
});
(function ($, window, document, undefined) {
  var upperCase = new RegExp("[A-Z]");
  var lowerCase = new RegExp("[a-z]");
  var numbers = new RegExp("[0-9]");

  $.widget("namespace.strength_meter", {
    //Options to be used as defaults
    options: {
      strengthWrapperClass: "strength_wrapper",
      inputClass: "input-text clave",
      strengthMeterClass: "strength_meter",
      toggleButtonClass: "button_strength",
    },

    _create: function () {
      var options = this.options;

      //Note. Instead of this you can use templating. I did not want to have addition dependencies.
      this.element.addClass(options.strengthWrapperClass);
      this.element.append(
        '<div class="' +
          options.strengthMeterClass +
          '"><div id="fortaleza"><p></p></div></div>'
      );
      this.element.append(
        '<div class="pswd_info" style="display: none;"> \
                <h4>La contraseña debe incluir:</h4> \
                <ul> \
                <li data-criterion="length" class="valid">8-20 <strong>Carácteres</strong></li> \
                <li data-criterion="capital" class="valid">Añade minimo <strong>una letra mayuscula</strong></li> \
                <li data-criterion="number" class="valid">Añade minimo <strong>un número</strong></li> \
                <li data-criterion="letter" class="valid">No agregues espacios</li> \
                </ul> \
                </div>'
      );

      //this object contain all main inner elements which will be used in strength meter.
      this.content = {};

      this.content.$passwordInput = this.element.find('input[type="password"]');
      this.content.$toggleButton = this.element.find("a");
      this.content.$pswdInfo = this.element.find(".pswd_info");
      this.content.$strengthMeter = this.element.find(
        "." + options.strengthMeterClass
      );
      this.content.$dataMeter = this.content.$strengthMeter.find("div");

      this._bind_input_events(this.content.$passwordInput);

      var that = this;
      this.content.$toggleButton.bind("click", function (e) {
        e.preventDefault();

        that._toggle_input(that.content.$passwordInput);
      });
    },

    //Copy value from active input inside hidden.
    _sync_inputs: function ($s, $t) {
      $s.bind("keyup", function () {
        var password = $s.val();
        $t.val(password);
      });
    },

    _bind_input_events: function ($s) {
      var that = this;
      $s.bind("keyup", function () {
        var password = $s.val();

        var characters = password.length >= 8;
        var capitalletters = password.match(upperCase) ? 1 : 0;
        var loweletters = password.match(lowerCase) ? 1 : 0;
        var number = password.match(numbers) ? 1 : 0;
        var containWhiteSpace = password.indexOf(" ") >= 0 ? 1 : 0;

        var total = characters + capitalletters + loweletters + number;
        that._update_indicator(total);

        that._update_info(
          "length",
          password.length >= 8 && password.length <= 20
        );
        that._update_info("capital", capitalletters);
        that._update_info("number", number);
        that._update_info("letter", !containWhiteSpace);
      })
        .focus(function () {
          that.content.$pswdInfo.show();
        })
        .blur(function () {
          that.content.$pswdInfo.hide();
        });
    },

    _update_indicator: function (total) {
      var meter = this.content.$dataMeter;

      meter.removeClass();
      if (total === 0) {
        meter.html("");
      } else if (total === 1) {
        meter.addClass("veryweak").html("<p>Muy débil</p>");
      } else if (total === 2) {
        meter.addClass("weak").html("<p>Débil</p>");
      } else if (total === 3) {
        meter.addClass("medium").html("<p>Mediana</p>");
      } else {
        meter.addClass("strong").html("<p>Fuerte</p>");
      }
    },

    _update_info: function (criterion, isValid) {
      var $passwordCriteria = this.element.find(
        'li[data-criterion="' + criterion + '"]'
      );

      if (isValid) {
        $passwordCriteria.removeClass("invalid").addClass("valid");
      } else {
        $passwordCriteria.removeClass("valid").addClass("invalid");
      }
    },
  });
})(jQuery, window, document);
