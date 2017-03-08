$(function() {

    var legiSearch = new Vue({
        el: "#legiSearch",
        data: {
            query: "",
            apiKey: "2d28553a502d7fed3b68863b2f592f19",
            searchState: "OH",
            searchResult: {}
        },
        mounted: function() {
            $.ajax({
                method: "POST",
                url: "../pages/util/search.php",
                dataType: "json",
                data: {
                    state: "OH",
                    key: "2d28553a502d7fed3b68863b2f592f19",
                    op: "search"
                },
                success: function(res) {
                    delete res["searchresult"]["summary"];
                    legiSearch.searchResult = res["searchresult"];
                },
                error: function(req, textStatus, err) {
                    console.log(textStatus + ": " + err);
                }
            }); // AJAX
        },
        methods: {
            search: function() {
                $.ajax({
                    method: "POST",
                    url: "../pages/util/search.php",
                    dataType: "json",
                    data: {
                        state: "OH",
                        key: "2d28553a502d7fed3b68863b2f592f19",
                        op: "search",
                        query: legiSearch.query
                    },
                    success: function(res) {
                        delete res["searchresult"]["summary"];
                        legiSearch.searchResult = res["searchresult"];
                    },
                    error: function(req, textStatus, err) {
                        console.log(textStatus + ": " + err);
                    }
                }); // AJAX
            }
        }
    }); // LegiSearch

});
