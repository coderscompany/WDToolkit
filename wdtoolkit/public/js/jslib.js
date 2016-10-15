$(document).ready(function() {

	var theTitle = $('head title');
	theTitle.text('Encoder | WDT');

    function setMenuActive() {
        $('#hashform, #colors, #encoder, #uglyfier, #obfuscator').filter(':not(.converted)').addClass('converted').on('click', function() {
            $('#hashform, #colors, #encoder, #obfuscator').removeClass('active');
            $(this).addClass('active');
            addListeners();
        });
    }
	
    function assignAjax() {
        $('[name="compress"]').bootstrapSwitch();
        $('[name="compress[]"]').bootstrapSwitch();
        $('[name="strep"]').bootstrapSwitch();
        $('#stringreplace, #hashform, .btn-delete-hash, .btn-delete-color, #colors, #encoder, .deleteallhashes, #deleteallhashfiles, #deleteall, #obfuscator, #bitoperator').filter(':not(.converted)').addClass('converted').on('click', function(e) {
            var that = this;
            $.ajax({
                type: 'GET',
                url: '?do=obfuscator&action=resetrounds',
                cache: false,
                success: function(html) {
                }
            });
			var title = $(that).data('title') + ' | WDT' || 'WDToolkit';
			theTitle.text(title);
			$('.content').fadeOut(0, function() {
				$('.content').load($(that).attr('href'), function() {
					$('.content').fadeIn(0);
					addListeners();
				});
			});
			e.preventDefault();
		});
    }

    function strreplace() {
        $('#replaceall, #replacenext').on('click', function(e) {
            var formData = {
                before: $('#before').val(),
                search: $('#search').val(),
                replace: $('#replace').val()
            };
            if ($(this).attr('id') == 'replaceall') {
                var href = '?do=strreplace&action=replaceall';
            }
            else if ($(this).attr('id') == 'replacenext') {
                var href = '?do=strreplace&action=replacenext';
            }
            $.ajax({
                type: 'POST',
                url: href,
                data: formData

            }).done(function(data) {
                $('#after').val(data);
                if ($('#after').val() != '') {
                    $('.toencoder-group').fadeIn(0);
                }
            });
            e.preventDefault();
        });
    }

    function sendToBefore() {
        $('#sendtobefore').on('click', function(e) {
            $('#before').val($('#after').val());
            e.preventDefault();
        });
    }

    function sendToEncoder() {
        $('#sendtoencoder').on('click', function(e) {
            var replaced = $('#after').val();
            $('.content').load('?do=encoderAj', function() {
                $('#decoded').val(replaced);
            });
            e.preventDefault();
        });
    }

	
    function compressObfuscator() {
        $('#compress1, #compress2, #compress3, #compress4, #compress5').filter(':not(.converted)').addClass('converted').on('switchChange.bootstrapSwitch', function() {
            var round = $(this).attr('id').substr(8);
            if ($('#compress'+round).bootstrapSwitch('state') == true) {
                $('#str'+round).fadeIn(0);
                $('#strength'+round).fadeIn(0);
            }
            else {
                $('#str'+round).fadeOut(0);
                $('#strength'+round).fadeOut(0).val('1');
            }
        });
    }

    function addRound() {
        $('#addround1, #addround2, #addround3, #addround4, #addround5').on('click', function(e) {
            var that = this;
            var round = $(this).attr('id').substr(8);
            var href = $(this).attr('href');
            $.ajax({
                type: 'GET',
                url: href,
                cache: false,
                success: function(html) {
                    $('.rounds').append(html);
                    $(that).remove();
                    addListeners();

                }
            });
            e.preventDefault();
        });
    }

    function encode() {
        $('#encode').filter(':not(.converted)').addClass('converted').on('click', function(e) {
            var href = $('#decodedarea').attr('action') + '&action=encode';
            var formData = {
                decoded: $('#decoded').val(),
                algorithm: $('#algorithm').val(),
                compress: $('#compress').prop('checked'),
                strength: $('#strength').val()
            };
            $.ajax({
                type: 'POST',
                url:   href,
                data:  formData
            }).done(function (data) {
                $('#encoded').val(data);
                if ($('#algorithm').val() == 'bin') {
                    $('.sendtocreate').fadeIn(0);
                }
            });
            e.preventDefault();
        });
    }

    function decode() {
        $('#decode').filter(':not(.converted)').addClass('converted').on('click', function(e) {
            var href = $('#decodedarea').attr('action') + '&action=decode';
            var formData = {
                encoded: $('#encoded').val(),
                algorithm: $('#algorithm').val(),
                compress: $('#compress').prop('checked')
            };
            $.ajax({
                type: 'POST',
                url:   href,
                data:  formData
            }).done(function (data) {
                $('#decoded').val(data);
            });
            e.preventDefault();
        });
    }

    /*
    * Sends output from encoder to Bitoperator if encoding was 'binary'
    * */
    function sendToBitoperator() {
        $('#sendtofirst, #sendtosecond').on('click', function(e) {
            var placeholder;
            if ($(this).attr('id') == 'sendtofirst') {
                placeholder = 'first';
            } else {
                placeholder = 'second';
            }
            $.ajax({
                type: 'GET',
                url: '?do=storeinsession&var=' + placeholder + '&value=' + $('#encoded').val(),
                cache: false,
                success: function(html) {

                }
            });
            e.preventDefault();
        });
    }

    function algorithm() {
        $('#algorithm').filter(':not(.converted)').addClass('converted').on('change', function() {
            if ($('#algorithm').val() != 'base64') {
                $('#comp').css('display', 'none');
                $('.compressbox').hide();
                $('#str').css('display', 'none');
                $('#strength').css('display', 'none').val(1);
            }
            else {
                $('#comp').fadeIn(0);
                $('.compressbox').show();
            }
        });
    }

    function compress() {
        $('#compress').filter(':not(.converted)').addClass('converted').on('switchChange.bootstrapSwitch', function() {
            if ($('#compress').bootstrapSwitch('state') == true) {
                $('#str').fadeIn(0);
                $('#strength').fadeIn(0);
            }
            else {
                $('#str').fadeOut(0);
                $('#strength').fadeOut(0).val('1');
            }
        });
    }

    function nameless() {
        $('#encoded, #hashvaluef, #hashvalue, #after').filter(':not(.converted)').addClass('converted').on('click', function(e) {
            $(this).select();
            e.preventDefault();
        });
    }

    function hash() {
        $('#hash').filter(':not(.converted)').addClass('converted').on('click', function (e) {
            var href = $('#stringhasher').attr('action');
            var formData = {
                plain: $('#plain').val(),
                algo: $('#algo').val(),
                salt: $('#salt').val()
            };
            $.ajax({
                type: 'POST',
                url:  href,
                data: formData
            }).done(function (data) {
                $('.content').load('?do=hasher', function() {
                    theTitle.text('Hasher | WDT');
                    addListeners();
                });
            });
            e.preventDefault();
        });
    }

    function hashf() {
        $('#hashf').filter(':not(.converted)').addClass('converted').on('click', function(e) {
            var href = $('#filehasher').attr('action');
            var formData = {
                algo: $('#algof').val(),
                file: $('#hashfile').prop('files')[0]
            };
            $.ajax({
                type: 'POST',
                url:  href,
                data: formData
            }).done(function (data) {
                $('.content').load('?do=hasher', function() {
                    theTitle.text('Hasher | WDT');
                    addListeners();

                });
            });

            e.preventDefault();
        });
    }

    function rehashHash() {
        $('.btn-rehash-hash').on('click', function(e) {
            var that = this;
            var href = $(this).attr('href');
            $.ajax({
                type: 'GET',
                url: href,
                cache: false,
                success: function(html) {
                    var result = JSON.parse(html);
                    $('#plain').val(result.plain);
                    $('#salt').val(result.salt);
                    $('#hashvalue').val(result.hash);
                    $(that).remove();
                    addListeners();
                }
            });
            e.preventDefault();
        });
    }

    function colorpicker() {
        $('#color').filter(':not(.converted)').addClass('converted').on('change', function(e) {
            var href = '?do=colors&action=rgb2hex';
            var formData = {
                color: $('.colorpicker').val()
            };
            $.ajax({
                type: 'POST',
                url: href,
                data: formData
            }).done(function(data) {
                $('.content').load(href, function() {
                    addListeners();
                });
            });
            e.preventDefault();
        });
    }

    function selectHashedValue() {
        $('#hashedvalue').on('click', function(e) {
            $(this).select();
            e.preventDefault();
        });
    }

    function bitOperator() {
        $('#xor, #or, #and').on('click', function(e) {
            var operation = $(this).attr('id');
            var href = '?do=bitoperator&action=' + operation;
            var formData = {
                first: $('#first').val(),
                second: $('#second').val()
            };
            $.ajax({
                type: 'POST',
                url:   href,
                data:  formData
            }).done(function(data) {
                $('#binaryresult').val(data);
            });
            e.preventDefault();
        });
    }

    function addListeners() {
        assignAjax();
        encode();
        decode();
        algorithm();
        compress();
        nameless();
        hash();
        hashf();
        colorpicker();
        selectHashedValue();
        setMenuActive();
        compressObfuscator();
        addRound();
        rehashHash();
        strreplace();
        sendToBefore();
        sendToEncoder();
        sendToBitoperator();
        bitOperator();
        $( "#tabs" ).tabs();
    }
    addListeners();
});