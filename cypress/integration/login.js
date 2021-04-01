describe('Login', function () {
    it('can be viewed', function () {
        cy.visit('/login')
    });

    it('must have valid credentials', function () {
        cy.visit('/login').get('[type="email"]').type('test@test.com')
            .get('[type="password"]').type('pass_bad')
            .get('[type="submit"]').click()
            .window()
            .contains('These credentials do not match our records.')
    });

    it('works', function () {
        cy.visit('/login').get('[type="email"]').type('buyer@creator-core.com')
            .get('[type="password"]').type('password')
            .get('[type="submit"]').click()
            .assertRedirect('/dashboard')
    });
});
