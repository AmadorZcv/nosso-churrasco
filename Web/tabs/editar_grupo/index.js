const timePickerOptions = {
  twelveHour: false,
};
const options = {
  i18n: {
    months: [
      'Janeiro',
      'Fevereiro',
      'Março',
      'Abril',
      'Maio',
      'Junho',
      'Julho',
      'Agosto',
      'Setembro',
      'Outubro',
      'Novembro',
      'Dezembro',
    ],
    monthsShort: [
      'Jan',
      'Fev',
      'Mar',
      'Abr',
      'Mai',
      'Jun',
      'Jul',
      'Ago',
      'Set',
      'Out',
      'Nov',
      'Dez',
    ],
    weekdays: [
      'Domingo',
      'Segunda',
      'Terça',
      'Quarta',
      'Quinta',
      'Sexta',
      'Sabádo',
    ],
    weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
    weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
    today: 'Hoje',
    clear: 'Limpar',
    cancel: 'Sair',
    done: 'Confirmar',
    labelMonthNext: 'Próximo mês',
    labelMonthPrev: 'Mês anterior',
    labelMonthSelect: 'Selecione um mês',
    labelYearSelect: 'Selecione um ano',
    selectMonths: true,
    selectYears: 15,
  },
  format: 'yyyy-mm-dd',
  container: 'body',
  minDate: new Date (),
};
let listNomes = [];
document.addEventListener ('DOMContentLoaded', function () {
  var elems = document.querySelectorAll ('.datepicker');
  var timepickerElement = document.querySelectorAll ('.timepicker');
  var instances = M.Datepicker.init (elems, options);
  var timepicker = M.Timepicker.init (timepickerElement, timePickerOptions);
  timepicker.makeUL (listNomes);
  document
    .getElementById ('data')
    .addEventListener ('change', function (time, hello) {
      console.log (time, hello);
    });
});

let dateTest = new Date ();
function onDateChange (date) {
  console.log ('Date is ', date);
}
function logArrayElements (element, index, array) {
  console.log ('Elementei s ', element);
  console.log ('Index is ', index);
  let head = document.createElement ('tr');
  let item = document.createElement ('td');
  let itemIcon = document.createElement ('td');
  let icon = document.createElement ('i');
  icon.setAttribute ('class', 'material-icons right');
  icon.setAttribute ('onclick', `removeItem(${index})`);
  icon.appendChild (document.createTextNode ('remove_circle'));
  item.appendChild (document.createTextNode (element));
  itemIcon.appendChild (icon);
  head.appendChild (item);
  head.appendChild (itemIcon);
  document.getElementById ('list').appendChild (head);
}
function makeUL (array) {
  // Create the list element:
  array.forEach (logArrayElements);
}
function addNome () {
  if (document.getElementById ('nome').value !== '') {
    const nome = document.getElementById ('nome').value;
    listNomes.push (nome);
    const id = listNomes.length - 1;
    let head = document.createElement ('tr');
    let item = document.createElement ('td');
    let itemIcon = document.createElement ('td');
    let icon = document.createElement ('i');
    icon.setAttribute ('class', 'material-icons right');
    icon.setAttribute ('onclick', `removeItem(${id})`);
    icon.appendChild (document.createTextNode ('remove_circle'));
    item.appendChild (document.createTextNode (nome));
    itemIcon.appendChild (icon);
    head.appendChild (item);
    head.appendChild (itemIcon);
    head.setAttribute ('id', id.toString ());
    document.getElementById ('list').appendChild (head);
    document.getElementById ('nome').value = '';
  }
}
function removeItem (id) {
  const parent = document.getElementById ('list');
  const nested = document.getElementById (id);
  v;
  listNomes.splice (parseInt (id), 1);
  console.log ('List items são', listNomes);
  parent.removeChild (nested);
}
