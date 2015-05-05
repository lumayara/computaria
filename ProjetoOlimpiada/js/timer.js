
/*
 * Contador Regressivo
 */
function atualizaContador(startDate, id) {
    var hoje = new Date();
    var fuso = (hoje.getTimezoneOffset() / 60) - 3;
    if (fuso)
        hoje = new Date(hoje.valueOf() + (fuso * 3600000));
    var futuro = new Date(startDate);

    var ss = parseInt((futuro - hoje) / 1000);
    var mm = parseInt(ss / 60);
    var hh = parseInt(mm / 60);
    var dd = parseInt(hh / 24);

    ss = ss - (mm * 60);
    mm = mm - (hh * 60);
    hh = hh - (dd * 24);


    var faltam = '';
    faltam += (dd && dd > 1) ? dd + ' dias, ' : (dd == 1 ? '1 dia, ' : '');
    faltam += (toString(hh).length) ? hh + ' hr, ' : '';
    faltam += (toString(mm).length) ? mm + ' min e ' : '';
    faltam += ss + ' seg';

    if (dd + hh + mm + ss > 0) {
        document.getElementById(id).innerHTML = faltam;
        setTimeout(function(){atualizaContador(startDate, id)}, 1000);
    } else {
        document.getElementById(id).innerHTML = 'Teste já iniciou!';
    }
}