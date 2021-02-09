describe('Login', function () {
    it('can be viewed', function () {
        cy.visit('/login')
    });
    it('can be submitted', function () {
        cy.visit('/login').get('[type="email"]').type('email@test.com')
            .get('[type="password"]').type('123123123')
            .get('[type="submit"]').click()
    });
    it('authenticates', function () {

    });
    it('cannot be accessed while logged in', function () {
    });
});
