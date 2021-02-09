describe('Commissions', function () {
    describe('Creating a Commission', function () {
        it('should Create a Commission', function () {
            cy.login({'name': 'test', 'email': 'test@test.com'}).visit('/commissions/new/test')
        });
    });
});
