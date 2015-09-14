<?php
class AttributeType {
	const text = 0;
	const textArea = 1;
	const email = 2;
	const weblink = 3;
	const number = 4;
}

class AttributeParsar {
	static function toHTMLElement($attribute) {
		switch ($attribute->getType()) {
			case AttributeType::text:
				break;
			case AttributeType::textArea:
				break;
			case AttributeType::email:
				break;
			case AttributeType::weblink:
				break;
			case AttributeType::number:
				break;
			default:
		}
	}
	
	static function isValueSatisfiedAttributeType($attributeSchema, $value) {
		switch ($attributeSchema->getType()) {
			case AttributeType::text:
				break;
			case AttributeType::textArea:
				break;
			case AttributeType::email:
				break;
			case AttributeType::weblink:
				break;
			case AttributeType::number:
				break;
			default:
		}
	}
}

