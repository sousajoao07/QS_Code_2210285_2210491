
Given(/^I am logged in as an Admin$/, () => {
    cy.visit('http://frutos.test/admin')
        cy.get('.login-form .div')
            .first()
            .type('admin@email.pt')
            .next()
            .type('123456\r')
            
        cy.get('.navbar-nav .nav-item')
            .eq(3)
            .click()       
        
        cy.get('.list-group-item')
            .eq(2)
            .click()

});
 
Given(/^I am in the Admin menu$/, () => {
});
 
Given(/^clicked on products option$/, () => {
});
 
Given(/^see products list$/, () => {
});
 
When(/^I Click on add button$/, () => {
});
 
When(/^the form is displayed$/, () => {
});
 
When(/^fill in all the fields$/, () => {
});
 
Then(/^the product will be added$/, () => {
});
 
Then(/^I am redirected to the products list$/, () => {
});
 
Then(/^I can see the new product$/, () => {
});
 
Given(/^I am logged in as an Admin$/, () => {
});
 
Given(/^I am in the Admin menu$/, () => {
});
 
Given(/^clicked on products option$/, () => {
});
 
Given(/^see products list$/, () => {
});
 
When(/^I Click on add button$/, () => {
});
 
When(/^the form is displayed$/, () => {
});
 
When(/^I dont´t fill all the fields    And submit$/, () => {
});
 
Then(/^the product will not be added$/, () => {
});
 
Then(/^an error message "([^"]*)" is displayed$/, (arg0,) => {
});
 
Then(/^I am redirected to the products list$/, () => {
});