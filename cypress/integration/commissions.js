describe('Commissions', function () {
    describe('Create / Store', function () {
        it('creates a Commission', function () {
            cy.login({'email': 'buyer@creator-core.com'}).visit('/commissions/new/creator')
                .get('[name="title"]').type('Test Title')
                .get('[name="description"]').type('Test Description')
                .get('[name="memo"]').type('Test Memo')
                .get('[name="price"]').type('43.21')
                .get('[name="days_to_complete"]').type('12')
                .get('[type="submit"]').click()
                .assertRedirect('/commissions/' + '1-test-title')
        });
    });
    describe('Show', function () {
        it('can show a commission', function () {
            cy.login({ email: 'buyer@creator-core.com'})
            .visit('/commissions/' + '1-test-title')
            .contains('Test Title')
            .window()
            .contains('Test Description')
            .window()
            .contains('$543.21')
            .window()
            .contains('5')
        });
    });
});
