/// <reference types="Cypress" />

describe('FRUTOS OESTE TESTING', () => {
    const filepath = 'images/biologicos.jpg'
    beforeEach(() => {
        cy.visit('http://34.140.46.213/admin')
 
        cy.get('.login-form .div')
            .first()
            .type('admin@email.pt')
            .next()
            .type('123456\r')
            
        cy.get('.navbar-nav .nav-item')
            .eq(3)
            .click()       
        
        cy.get('.list-group-item')
            .eq(1)
            .click()
    })

    it('Add Category', () => {
        cy.get('.card-header .btn')
            .click()

        cy.get('.form-control')
            .eq(0)
            .type('Bio')

        cy.get('.form-control')
            .get('input[type="file"]')
            .attachFile(filepath)
            .get('.form-group .btn')
            .first()
            .click()
        
        cy.get('.table > tbody')
            .should('have.length', 7)

        //logout para iniciar o próximo teste
        cy.get('.navbar-nav .nav-item')
        .eq(4)
        .click()  

    })

    it('Remove Category', () => {
        cy.get('.table > tbody')
        .should('have.length', 7)
        .eq(1)
        .should('contain','Bio')
        .find('>td').eq(2)
        .then(elem => {
            elem[0].children[0].firstChild.click()
        })
   
        cy.get('.table > tbody')
        .should('have.length', 6)

        cy.get('.navbar-nav .nav-item')
        .eq(4)
        .click()  
        
    })
})