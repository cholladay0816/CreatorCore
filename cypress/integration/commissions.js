describe('Commissions', function () {
    beforeEach(() => {
        cy.refreshDatabase();
        cy.create('App\\Models\\User', {
            name: 'test',
            email: 'test@test.com',
        })
    })
    describe('Create / Store', function () {
        it('creates a Commission', function () {
            cy.login({'email': 'test@test.com'}).visit('/commissions/new/test')
                .get('[name="title"]').type('Test Title')
                .get('[name="description"]').type('Test Description')
                .get('[name="memo"]').type('Test Memo')
                .get('[name="price"]').type('6')
                .get('[name="days_to_complete"]').type('12')
                .get('[type="submit"]').click()
                .assertRedirect('/commissions/' + '1-test-title')
        }).skip();
    });
    describe('Show', function () {
        it('can show a commission', function () {
            cy.create('App\\Models\\Commission', {
                buyer_id: 1,
                creator_id: 1,
                commission_preset_id: null,
                title: 'Test Title',
                description: 'Test Description',
                memo: 'Test Memo',
                price: '543.21',
                days_to_complete: 5,

            })
            .login({ email: 'test@test.com'})
            .visit('/commissions/' + '1-test-title')
            .contains('Test Title')
            .window()
            .contains('Test Description')
            .window()
            .contains('$543.21')
            .window()
            .contains('5')
        }).skip();
    });
});
