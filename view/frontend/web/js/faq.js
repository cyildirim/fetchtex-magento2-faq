define(['jquery', 'apollo-client'], function ($, ApolloBoost) {
    'use strict';

    const {ApolloClient, gql} = ApolloBoost;

    const client = new ApolloClient({url: '/graphql'});

    const query = gql(`
    query myFaq {
      allfaqs(filter: {}) {
        items {
          question
          answer
          category{
            name
          }
        }
        total_count
      }
    }
    `);


    $(document).ready(function () {
        'use strict';
        client.query({
            query: query,
            variables: {
                pageSize: 2
            }
        })
            .then(function (data) {
                var accordionElement = document.createElement("div");

                $(accordionElement).attr('id', "accordion");
                $(accordionElement).attr("data-mage-init", '{"accordion":{ "collapsible": true,"openedState": "active","multipleCollapsible": true}}');
                $("#faq-list").append(accordionElement);

                renderFaqs(data);

            })
            .catch(console.error);


        $("#faq-search-input").on("keyup", function (e) {
            console.log("search for=" + e.target.value);
            var searchQuery = gql(`
                query myFaq {
                      allfaqs(filter: { question:"%` + e.target.value + `%"}) {
                        items {
                          question
                          answer
                          category{
                            name
                          }
                        }
                        total_count
                      }
                    }
                `);

            client.query({
                query: searchQuery
            })
                .then(function (data) {
                    $("#faq-list").html(" ");
                    var accordionElement = document.createElement("div");

                    $(accordionElement).attr('id', "accordion");
                    $(accordionElement).attr("data-mage-init", '{"accordion":{ "collapsible": true,"openedState": "active","multipleCollapsible": true}}');
                    $("#faq-list").append(accordionElement);

                    renderFaqs(data);
                })

        })

    });

    function renderFaqs(data) {
        data.data.allfaqs.items.map(function (faq, index) {

            var accordion = document.createElement("div");
            $(accordion).attr("data-role", "collapsible");
            var title = document.createElement("div");
            $(title).attr("data-role", "trigger").html('<h4>' + faq.question + '</h4> <span>'+faq.category.name+'</span>');
            var content = document.createElement("p");
            $(content).attr("data-role", "content").html(faq.answer);
            $(accordion).append(title, content);
            $("#accordion").append(accordion);
        });

        $("#faq-list").trigger('contentUpdated');
    }

});
