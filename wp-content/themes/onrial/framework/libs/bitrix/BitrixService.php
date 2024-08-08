<?php

class BitrixService
{
    const STATUS_ID_FOR_LEAD = 'NEW';
    const ASSIGNED = 9010;
    const WHAT_DO_YOU_DO =
        [
            'SALON' => 1445,
            'STORE' => 1447,
            'EDUCATION CENTER' => 1449,
            'I AM BLOGGER' => 1451,
        ];

    protected Logger $log;

    public function __construct(Logger $log)
    {
        $this->log = $log;
    }

    public function findContactByEmail($email)
    {
        return CRest::call(
            'crm.duplicate.findbycomm',
            [
                'entity_type' => 'CONTACT',
                'type' => 'EMAIL',
                'values' => [$email]
            ]
        );
    }

    public function findContactByPhone($phone)
    {
        return CRest::call(
            'crm.duplicate.findbycomm',
            [
                'entity_type' => 'CONTACT',
                'type' => 'PHONE',
                'values' => [$phone]
            ]
        );
    }

    public function createLead(array $leadFields, array $contactFields, int $contactID = null)
    {
        $data = [
            "TITLE" => $leadFields['title'] ?? 'Лид с сайта',
            "STATUS_ID" => self::STATUS_ID_FOR_LEAD,
            "ASSIGNED_BY_ID" => $leadFields['assigned_id'] ?? self::ASSIGNED,
            "COMMENTS" => $contactFields['message'] ?? '',
            "UF_CRM_1675889728" => !empty($contactFields['message']) ? self::WHAT_DO_YOU_DO[$contactFields['what_do_you_do']] : '',
            "UF_CRM_INSTAGRAM" => $contactFields['instagram'] ?? '', //Link for Instagram
            "UF_CRM_1675890673" => $contactFields['buy'] ?? '', //Where did you buy our products?
            "UF_CRM_1675891057" => $contactFields['customer'] ?? '', //Are you already our wholesale customer?
            "UF_CRM_1675891118" => $contactFields['other'] ?? '', //You are an ambassador of other brands?
            "UF_CRM_1534157841520" => $contactFields['page'] ?? '', //Заявка пришла со страницы:
            "UTM_CAMPAIGN" => $leadFields['utm_campaign'] ?? '',
            "UTM_CONTENT" => $leadFields['utm_content'] ?? '',
            "UTM_MEDIUM" => $leadFields['utm_medium'] ?? '',
            "UTM_SOURCE" => $leadFields['utm_source'] ?? '',
            "UTM_TERM" => $leadFields['utm_term'] ?? '',
        ];

        if ($contactID !== null) {
            $data["CONTACT_ID"] = $contactID;
        } else {
            $data["NAME"] = $contactFields['name'] ?? '';
            $data["LAST_NAME"] = $contactFields['last_name'] ?? '';
            $data["PHONE"] = !empty($contactFields['phone']) ? [["VALUE" => $contactFields['phone'], "VALUE_TYPE" => "WORK"]] : [];
            $data["EMAIL"] = !empty($contactFields['email']) ? [["VALUE" => $contactFields['email'], "VALUE_TYPE" => "WORK"]] : [];
        }

        return CRest::call(
            'crm.lead.add',
            [
                'fields' => $data
            ]
        );
    }

    public function createContact(array $contactFields)
    {
        $data = [
            'NAME' => $contactFields['name'],
            "LAST_NAME" => $contactFields['last_name'] ?? '',
            "ASSIGNED_BY_ID" => 1,
            "PHONE" => !empty($contactFields['phone']) ? [["VALUE" => $contactFields['phone'], "VALUE_TYPE" => "WORK"]] : [],
            "EMAIL" => !empty($contactFields['email']) ? [["VALUE" => $contactFields['email'], "VALUE_TYPE" => "WORK"]] : [],
        ];

        return CRest::call(
            'crm.contact.add',
            [
                'fields' => $data
            ]
        );
    }
}
