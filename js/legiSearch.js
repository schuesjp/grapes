$(function() {

    var legiSearch = new Vue({
        el: "#legiSearch",
        data: {
            query: "",
            apiKey: "2d28553a502d7fed3b68863b2f592f19",
            searchState: "OH",
            searchResult: []
        },
        mounted: function() {
            $.ajax({
                method: "POST",
                dataType: "json",
                url: "../pages/util/search.php",
                data: {
                    state: legiSearch.searchState,
                    APIkey: legiSearch.apiKey
                },
                success: function(res) {
                    // to do
                },
                error: function(req, textStatus, err) {
                    console.log(textStatus + ": " + err);
                }
            }); // AJAX
        }
    }); // LegiSearch

});
