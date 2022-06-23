/// <reference types="Cypress" />

describe('FRUTOS OESTE TESTING', () => {
    const filepathCategory = 'images/biologicos.jpg'
    const filepathProduct = 'images/tremoco.png'

    //////////////////COMMON////////////////////

    beforeEach(() => {
        cy.visit('http://34.140.46.213/admin')
 
        cy.get('.login-form .div')
            .first()
            .type('admin@email.pt')
            .next()
            .type('123456\r')
            .wait(3000)
            
        cy.get('.navbar-nav .nav-item')
            .eq(3)
            .click()       
    })

    //////////////////ADD CATEGORY////////////////////

    it('Add Category', () => {
        cy.get('.list-group-item')
            .eq(1)
            .click()

        cy.get('.card-header .btn')
            .click()

        cy.get('.form-control')
            .eq(0)
            .type('Bio')

        cy.get('.form-control')
            .get('input[type="file"]')
            .attachFile(filepathCategory)
            .wait(3000)    

        cy.get('.form-group .btn')
            .first()
            .click()

         cy.wait(2000)
    })

    //////////////////REMOVE CATEGORY////////////////////

    it('Remove Category', () => {
        cy.get('.list-group-item')
            .eq(1)
            .click()
            .wait(2000)  

        cy.get('.table > tbody')
            .eq(1)
            .should('contain','Bio')
            .find('>td').eq(2)
            .then(elem => {
                elem[0].children[0].firstChild.click()
        })

        cy.wait(2000)
    })

    //////////////////ADD PRODUCT////////////////////

    it('Add Product', () => {
        cy.get('.list-group-item')
            .eq(2)
            .click()
            .wait(2000)

        cy.get('.card-header .btn')
            .click()

        cy.get('#name')
            .type('Tremoco')

        cy.get('.form-control')
            .eq(1)
            .type('100% Biologico')
        
        cy.get('#categoryId')
            .select('Aperitivos')

        cy.get('.form-control')
            .get('input[type="file"]')
            .attachFile(filepathProduct)
            .wait(2000)

        cy.get('.form-group .btn')
            .first()
            .click()
        
        cy.wait(2000)
    })

    //////////////////REMOVE PRODUCT////////////////////

    it('Remove Product', () => {
        cy.get('.list-group-item')
            .eq(2)
            .click()
            .wait(2000)

        cy.get('.table > tbody')
            .eq(0)
            .should('contain','Tremoco')
            .find('>td').eq(4)
            .then(elem => {
                elem[0].children[0].firstChild.click()
        })

        cy.get('.navbar-nav .nav-item')
            .eq(4)
            .click()
    })
})