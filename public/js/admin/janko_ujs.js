(function($, undefined) {

/**
 * Адаптер для jQuery (Unobstructive javascript)
 * Позволяет "скрывать" js-код
 * Основан на rails-ujs: https://github.com/rails/jquery-ujs
 */

  // Проверка повторного включения кода в страницу
  if ( $.janko !== undefined ) {
    $.error('janko_ujs уже загружен!');
  }

  // Переменные для удобства
  var janko;
  var $document = $(document);

  $.janko = janko = {
    // Селектор
    linkClickSelector: 'a[data-confirm], a[data-method], a[data-remote], a[data-disable-with], a[data-disable]',

    // Селектор ссылок, для которых необходимо запретить повторную обработку щелчка
    // пока не отработает ajax
    linkDisableSelector: 'a[data-disable-with], a[data-disable]',

    // Функция оправки ajax по умолчанию. Можно переопределить в $.janko.ajax
    ajax: function(options) {
      return $.ajax(options);
    },

    // Вызывает событие на элементе. Возвращает false, если событие вернуло false
    fire: function(obj, name, data) {
      var event = $.Event(name);
      obj.trigger(event, data);
      return event.result !== false;
    },

    //  заменяет html элемента значением 'data-disable-with', сохранив предварительно имеющийся html,
    //  а так же предотвращает щелчок по элементу
    disableElement: function(element) {
      var replacement = element.data('disable-with');

      element.data('ujs:enable-with', element.html()); // сохраняет "включенное" состояние
      console.log(element.data('ujs:enable-with'));
      if (replacement !== undefined) {
        element.html(replacement);
      }

      element.bind('click.jankoDisable', function(e) { // запрещает повторный щелчок
        return janko.stopEverything(e);
      });
    },

    // восстанавливает первоначальное состояние элемента, выключенного с помощью 'disableElement'
    enableElement: function(element) {
      console.log('enabling');
      if (element.data('ujs:enable-with') !== undefined && !element.data('dont-enable')) {
        console.log('have cache');
        element.html(element.data('ujs:enable-with')); // устанавливает html до выключения
        element.removeData('ujs:enable-with');         // чистит кэш
      }
      element.unbind('click.jankoDisable');            // включает элемент
    },

    // Диалог подтверждения. Можно переопределить в $.janko.confirm
    confirm: function(message) {
      return confirm(message);
    },

    // Получение ссылки элемента. Можно переопределить в $.janko.href.
    href: function(element) {
      return element.attr('href');
    },

    // Создает форму из ссылок с аттрибутом "data-method":
    // <a href="/acp/posts/5" data-method="delete" rel="nofollow" data-confirm="Вы уверены?">Удалить</a>
    handleMethod: function(link) {
      var href = janko.href(link),
        method = link.data('method'),
        target = link.attr('target'),
        form = $('<form method="post" action="' + href + '"></form>'),
        metadataInput = '<input name="_method" value="' + method + '" type="hidden" />';
      if (target) { form.attr('target', target); }

      form.hide().append(metadataInput).appendTo('body');
      form.submit();
    },

    // Делает ajax-запросы при клике по ссылке с data-remote = true
    handleRemote: function(element) {
      if (janko.fire(element, 'ajax:before')) {
        elCrossDomain = element.data('cross-domain');
        crossDomain = elCrossDomain === undefined ? null : elCrossDomain;
        withCredentials = element.data('with-credentials') || null;
        dataType = element.data('type') || ($.ajaxSettings && $.ajaxSettings.dataType);
        method = element.data('method');
        url = janko.href(element);
        data = element.data('params') || null;

        options = {
          type: method || 'GET', data: data, dataType: dataType,
          // если обработчик "ajax:beforeSend" вернет false, запрос не будет выполнен
          beforeSend: function(xhr, settings) {
            if (settings.dataType === undefined) {
              xhr.setRequestHeader('accept', '*/*;q=0.5, ' + settings.accepts.script);
            }
            if (janko.fire(element, 'ajax:beforeSend', [xhr, settings])) {
              element.trigger('ajax:send', xhr);
            } else {
              return false;
            }
          },
          success: function(data, status, xhr) {
            element.trigger('ajax:success', [data, status, xhr]);
          },
          complete: function(xhr, status) {
            element.trigger('ajax:complete', [xhr, status]);
          },
          error: function(xhr, status, error) {
            element.trigger('ajax:error', [xhr, status, error]);
          },
          crossDomain: crossDomain
        };

        // Для IE6-8 нельзя задать withCredentials, если
        // опция "Enable native XMLHTTP support" выключена
        if (withCredentials) {
          options.xhrFields = {
            withCredentials: withCredentials
          };
        }

        // Передаем url в настройки `ajax` только если ссылка не пустая
        if (url) { options.url = url; }

        return janko.ajax(options);
      } else {
        return false;
      }
    },

   /* Для элементов с аттрибутом 'data-confirm':
      - Вызывает событие `confirm`
      - Показывает диалог подтверждения
      - Вызывает событие `confirm:complete`

      Возвращает true, если функция прерывает цепь вызовов и пользователь подтверждает действие; иначе возвращает false.
      Обработчик, возвращающий 'ложь' для события 'confirm' отменяет диалог подтверждения.
      Обработчик, возвращающий 'ложь' для события 'confirm:complete' приводит к тому, что эта функция вернет false.
      Событие 'confirm:complete' вызывается независимо от того, что пользователь выбрал в диалоге подтверждения.
   */
    allowAction: function(element) {
      var message = element.data('confirm'),
          answer = false, callback;
      if (!message) { return true; }

      if (janko.fire(element, 'confirm')) {
        answer = janko.confirm(message);
        callback = janko.fire(element, 'confirm:complete', [answer]);
      }
      return answer && callback;
    },

    // Вспомогательная функция для IE
    stopEverything: function(e) {
      $(e.target).trigger('ujs:everythingStopped');
      e.stopImmediatePropagation();
      return false;
    }

  };

  if (janko.fire($document, 'janko:attachBindings')) {
    console.log('attaching binding');
    $document.delegate(janko.linkClickSelector, 'click.janko', function(e) {
      console.log('delegating');
      var link = $(this), method = link.data('method'), data = link.data('params'), metaClick = e.metaKey || e.ctrlKey;
      if (!janko.allowAction(link)) return janko.stopEverything(e);

      if (!metaClick && link.is(janko.linkDisableSelector)) janko.disableElement(link);

      if (link.data('remote') !== undefined) {
        if (metaClick && (!method || method === 'GET') && !data) { return true; }
        var handleRemote = janko.handleRemote(link);
        if (handleRemote === false) {
          janko.enableElement(link);
        } else {
          console.log('handle remote', handleRemote);
          handleRemote.done( function() { 'handle remote error fn()'; janko.enableElement(link); } );
        }
        return false;
      } else if (link.data('method')) {
        janko.handleMethod(link);
        return false;
      }
    });
  }

})( jQuery );