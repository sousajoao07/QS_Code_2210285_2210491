Feature: Search Product
    As an Admin 
    I want to search for a product
    So that I can easily see end manage it

Scenario: Search for a existing product
    Given I am logged in as an Admin 
    And I am in the Admin menu
    And clicked on products option 
    And see products list
    When I write the existing product name in the search bar 
    Then the matching product(s) are displayed on the table

Scenario: Search for a non existing product
    Given I am logged in as an Admin 
    And I am in the Admin menu
    And clicked on products option 
    And see products list
    When I write the non existing product name in the search bar 
    Then a toast message "Não foram encontrados resultados" is displayed 
    And no products will be shown 
