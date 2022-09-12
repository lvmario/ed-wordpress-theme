//Contacto Form Bouncer Config

var validate = new Bouncer('form', {
	messages: {
		missingValue: {
			checkbox: 'Este campo es obligatorio.',
			radio: 'Seleccione un valor.',
			select: 'Seleccione un valor.',
			'select-multiple': 'Seleccione al menosun valor.',
			default: 'Este campo es obligatorio.'
		},
		patternMismatch: {
			email: 'Ingresá un email válido.',
			url: 'Ingresá una URL válida.',
			number: 'Ingresá un número.',
			color: 'El código de color debe seguir el siguiente formato: #rrggbb',
			date: 'La fecha debe seguir el siguiente formato: DD-MM-AAAA',
			time: 'Use el formato de 24h. Ejemplo: 18:30',
			month: 'Use el formato MM-AAAA',
			phone: 'Ingresá un número de telefono válido.',
			default: 'Por favor, siga el formato sugerido.'
		},
		outOfRange: {
			over: 'Seleccione un valor que sea mayor que {max}.',
			under: 'Seleccione un valor que sea menor que {min}.'
		},
		wrongLength: {
			over: 'El texto debe tener hasta {maxLength} caracteres. Actualmente tiene {length} caracteres.',
			under: 'El texto debe tener {minLength} caracteres o mas. Actualmente tiene {length} caracteres.'
		}
	},

	messageAfterField: true,

	disableSubmit: true, // If true, native form submission is suppressed even when form validates

});