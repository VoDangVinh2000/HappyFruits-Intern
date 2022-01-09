$(document).ready(function(){
    
    if ($('.report_chart').length)
    {
        $('iframe').load(function() {
            $('.for_chart_filter').show();
            $('.for_chart_filter .start_date, .for_chart_filter .end_date').datepicker({language: 'vn', autoclose: true});
        });
        $('.report_chart').iframeAutoHeight();

        $('.for_chart_filter').each(function(){
            var self = $(this);
            self.find('.filter_search').click(function(){
                reloadIFrame($(this).parent().parent());
            });
        });

        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            $(e.target.hash).find('iframe').each(function(){
                if($(this).height() == 0){
                    reloadIFrame($(this).prev().find('.for_chart_filter'));
                }
            });
        })
    }
    
});

function reloadIFrame(pparent){
    var chart_id = pparent.attr('id').replace('-filter', '');
    var startDate = pparent.find('.start_date').val();
    var endDate = pparent.find('.end_date').val();
    blockElement(pparent.parent().parent());
    $('#' + chart_id + '-iframe').attr("src", base_url + 'bieu-do/'+chart_id+'?startdate=' + startDate + '&enddate=' + endDate);
    $('#' + chart_id + '-iframe').iframeAutoHeight({
        callback: function(newHeight){unblockElement(pparent.parent().parent());}
    });
}