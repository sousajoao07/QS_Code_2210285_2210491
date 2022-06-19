
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

When(/^I write the existing product name in the search bar$/, () => {
});
 
Then(/^the matching product(s) are displayed on the table$/, () => {
});
 
When(/^I write the non existing product name in the search bar$/, () => {
});
 
Then(/^a toast message "([^"]*)" is displayed$/, (arg0,) => {
});
 
Then(/^no products will be shown$/, () => {
});