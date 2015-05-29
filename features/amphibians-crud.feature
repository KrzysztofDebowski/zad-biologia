Feature: I would like to edit amphibians

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/amphibians/"
    Then I should not see "<amphibians>"
    And I follow "Create a new entry"
    Then I should see "Amphibians creation"
    When I fill in "Amphibians" with "<amphibians>"
    And I fill in "Age" with "<age>"
    And I press "Create"
    Then I should see "<amphibians>"
    And I should see "<age>"

  Examples:
    | amphibians       | age |
    | Salamander       |  15 |
    | Newt             |  10 |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/amphibians/"
    Then I should not see "<new-amphibians>"
    When I follow "<old-amphibians>"
    Then I should see "<old-amphibians>"
    When I follow "Edit"
    And I fill in "Amphibians" with "<new-amphibians>"
    And I fill in "Age" with "<new-age>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-amphibians>"
    And I should see "<new-age>"
    And I should not see "<old-amphibians>"

  Examples:
    | old-amphibians    | new-amphibians         | new-age    |
    | Salamander        | Spadefoot              |  6         |
    | Newt              | Tree frog              |  6         |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/amphibians/"
    Then I should see "<amphibians>"
    When I follow "<amphibians>"
    Then I should see "<amphibians>"
    When I press "Delete"
    Then I should not see "<amphibians>"

  Examples:
    | amphibians         |
    | Spadefoot          |
    | Tree frog          |

