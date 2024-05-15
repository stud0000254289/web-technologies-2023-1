class Pizza {
    constructor(type) {
        this.type = type;
        this.size = 'маленькая'; // По умолчанию размер маленький
        this.toppings = [];

        // Цены и калории по умолчанию для типов пицц
        this.prices = {
            'Маргарита': 500,
            'Пепперони': 800,
            'Баварская': 700
        };
        this.calories = {
            'Маргарита': 300,
            'Пепперони': 400,
            'Баварская': 450
        };

        // Цены и калории для размеров
        this.sizes = {
            'маленькая': { price: 100, calories: 100 },
            'большой': { price: 200, calories: 200 }
        };

        // Цены и калории для добавок
        this.additions = {
            'сливочная моцарелла': { price: 50, calories: 20 },
            'сырный борт': { price: 150, calories: 50, big: { price: 300, calories: 50 } },
            'чедер и пармезан': { price: 150, calories: 50, big: { price: 300, calories: 50 } }
        };
    }

    setSize(size) {
        if (this.sizes[size]) {
            this.size = size;
        }
    }

    addTopping(topping) {
        if (!this.toppings.includes(topping)) {
            this.toppings.push(topping);
        }
    }

    removeTopping(topping) {
        this.toppings = this.toppings.filter(t => t !== topping);
    }

    getToppings() {
        return this.toppings;
    }

    getSize() {
        return this.size;
    }

    getType() {
        return this.type;
    }

    calculatePrice() {
        let price = this.prices[this.type] + this.sizes[this.size].price;
        this.toppings.forEach(topping => {
            const addition = this.additions[topping];
            price += this.size === 'большой' && addition.big ? addition.big.price : addition.price;
        });
        return price;
    }

    calculateCalories() {
        let calories = this.calories[this.type] + this.sizes[this.size].calories;
        this.toppings.forEach(topping => {
            const addition = this.additions[topping];
            calories += this.size === 'большой' && addition.big ? addition.big.calories : addition.calories;
        });
        return calories;
    }
}

// Пример использования
let myPizza = new Pizza('Маргарита');
myPizza.setSize('большой');
myPizza.addTopping('сливочная моцарелла');
myPizza.addTopping('сырный борт');
console.log(`Стоимость: ${myPizza.calculatePrice()} руб.`);
console.log(`Калорийность: ${myPizza.calculateCalories()} Ккал.`);


