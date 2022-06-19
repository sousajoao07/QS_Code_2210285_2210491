Feature: Add Product
    As an Admin 
    I want to add a new product
    So that I can easily see end manage them in the list

Scenario: Add a new Product with all fields filled
    Given I am logged in as an Admin 
    And I am in the Admin menu
    And clicked on products option 
    And see products list 
    When I Click on add button
    And the form is displayed
    And fill in all the fields
    And submit 
    Then the product will be added
    And I am redirected to the products list
    And I can see the new product

Scenario: Add a new Product with one or more fields unfilled
    Given I am logged in as an Admin 
    And I am in the Admin menu
    And clicked on products option 
    And see products list 
    When I Click on add button
    And the form is displayed
    And I dont't fill all the fields    And submit 
    Then the product will not be added
    And an error message "Preencha os campos em falta." is displayed 
    And I am redirected to the products list